import './bootstrap';

const cart = {
    drawer: null,
    overlay: null,
    openButtons: [],
    closeButton: null,
    itemsContainer: null,
    emptyState: null,
    feedback: null,
    couponForm: null,
    couponMessage: null,
    notesForm: null,
    notesField: null,
    countBadges: [],
    countLabel: null,
    subtotalEl: null,
    discountEl: null,
    totalEl: null,
    addForm: null,
    addSubmit: null,
};

const routes = {
    items: '/cart/items',
    coupon: '/cart/coupon',
    notes: '/cart/notes',
};

const currency = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumFractionDigits: 0 });

function formatMoney(value) {
    return currency.format(Number(value || 0));
}

function csrfToken() {
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    return token || '';
}

async function requestJson(url, options = {}) {
    const headers = {
        Accept: 'application/json',
        'X-Requested-With': 'XMLHttpRequest',
        ...options.headers,
    };
    const response = await fetch(url, { credentials: 'same-origin', ...options, headers });
    const data = await response.json().catch(() => ({}));
    if (!response.ok) {
        const message = data.message || 'Terjadi kesalahan. Coba lagi.';
        throw new Error(message);
    }
    return data;
}

function setCartFeedback(message, type = 'info') {
    if (!cart.feedback) return;
    if (!message) {
        cart.feedback.classList.add('hidden');
        cart.feedback.textContent = '';
        return;
    }
    cart.feedback.textContent = message;
    cart.feedback.classList.remove('hidden');
    cart.feedback.classList.toggle('border-red-200', type === 'error');
    cart.feedback.classList.toggle('bg-red-50', type === 'error');
    cart.feedback.classList.toggle('text-red-700', type === 'error');
    cart.feedback.classList.toggle('border-gray-200', type !== 'error');
    cart.feedback.classList.toggle('bg-gray-50', type !== 'error');
    cart.feedback.classList.toggle('text-gray-700', type !== 'error');
}

function renderItems(items) {
    if (!cart.itemsContainer || !cart.emptyState) return;
    if (!items.length) {
        cart.itemsContainer.innerHTML = '';
        cart.emptyState.classList.remove('hidden');
        return;
    }
    cart.emptyState.classList.add('hidden');
    cart.itemsContainer.innerHTML = items.map((item) => `
        <article class="rounded-2xl border border-gray-200 p-4 shadow-sm" data-cart-item-id="${item.id}">
            <div class="flex items-start justify-between gap-3">
                <div class="min-w-0">
                    <h3 class="font-semibold text-gray-900 leading-snug">${item.name}</h3>
                    <p class="mt-1 text-xs text-gray-500">Size ${item.size}${item.length ? ` · ${item.length}` : ''}</p>
                </div>
                <p class="text-sm font-semibold text-gray-900">${formatMoney(item.price)}</p>
            </div>
            <div class="mt-3 flex items-center justify-between gap-3">
                <label class="flex items-center gap-2 text-xs text-gray-600">
                    <input type="checkbox" data-cart-select class="h-4 w-4 rounded border-gray-300 text-gray-900 focus:ring-gray-200" ${item.is_selected ? 'checked' : ''}>
                    Pilih item
                </label>
                <div class="flex items-center gap-2">
                    <input type="number" min="1" max="100" value="${item.quantity}" data-cart-quantity class="w-16 rounded-lg border border-gray-300 px-2 py-1 text-center text-sm font-semibold">
                    <button type="button" data-cart-remove class="rounded-lg border border-red-200 px-2 py-1 text-xs font-semibold text-red-600 transition hover:bg-red-50">Hapus</button>
                </div>
            </div>
        </article>
    `).join('');
}

function renderCart(payload) {
    renderItems(payload.items || []);
    const count = payload.count || 0;
    cart.countBadges.forEach((badge) => { badge.textContent = String(count); });
    if (cart.countLabel) cart.countLabel.textContent = `(${count})`;
    if (cart.subtotalEl) cart.subtotalEl.textContent = formatMoney(payload.subtotal);
    if (cart.discountEl) cart.discountEl.textContent = `− ${formatMoney(payload.discount)}`;
    if (cart.totalEl) cart.totalEl.textContent = formatMoney(payload.total);
    if (cart.couponMessage) {
        if (payload.coupon) {
            cart.couponMessage.textContent = `${payload.coupon.code} aktif (${payload.coupon.percentage}% diskon)`;
            cart.couponMessage.classList.remove('hidden');
        } else {
            cart.couponMessage.textContent = '';
            cart.couponMessage.classList.add('hidden');
        }
    }
    if (cart.notesField) cart.notesField.value = payload.notes || '';
}

async function refreshCart() {
    try {
        const payload = await requestJson(routes.items);
        renderCart(payload);
    } catch (error) {
        setCartFeedback(error.message, 'error');
    }
}

function openDrawer() {
    if (!cart.drawer || !cart.overlay) return;
    cart.drawer.classList.remove('translate-x-full');
    cart.drawer.setAttribute('aria-hidden', 'false');
    cart.overlay.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    cart.openButtons.forEach((btn) => btn.setAttribute('aria-expanded', 'true'));
    refreshCart();
}

function closeDrawer() {
    if (!cart.drawer || !cart.overlay) return;
    cart.drawer.classList.add('translate-x-full');
    cart.drawer.setAttribute('aria-hidden', 'true');
    cart.overlay.classList.add('hidden');
    document.body.style.overflow = '';
    cart.openButtons.forEach((btn) => btn.setAttribute('aria-expanded', 'false'));
}

async function submitCartForm(url, form) {
    const formData = new FormData(form);
    const response = await requestJson(url, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrfToken() },
        body: formData,
    });
    renderCart(response);
    return response;
}

function bindCartEvents() {
    cart.openButtons.forEach((btn) => btn.addEventListener('click', openDrawer));
    if (cart.closeButton) cart.closeButton.addEventListener('click', closeDrawer);
    if (cart.overlay) cart.overlay.addEventListener('click', closeDrawer);
    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape') closeDrawer();
    });

    if (cart.couponForm) {
        cart.couponForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            setCartFeedback('');
            try {
                await submitCartForm(routes.coupon, cart.couponForm);
            } catch (error) {
                setCartFeedback(error.message, 'error');
            }
        });
    }

    if (cart.notesForm) {
        cart.notesForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            setCartFeedback('');
            try {
                await submitCartForm(routes.notes, cart.notesForm);
            } catch (error) {
                setCartFeedback(error.message, 'error');
            }
        });
    }

    if (cart.itemsContainer) {
        cart.itemsContainer.addEventListener('change', async (event) => {
            const target = event.target;
            const itemCard = target.closest('[data-cart-item-id]');
            if (!itemCard) return;
            const itemId = itemCard.getAttribute('data-cart-item-id');
            if (target.matches('[data-cart-select]')) {
                try {
                    const payload = await requestJson(`/cart/items/${itemId}`, {
                        method: 'PATCH',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken() },
                        body: JSON.stringify({ is_selected: target.checked }),
                    });
                    renderCart(payload);
                } catch (error) {
                    setCartFeedback(error.message, 'error');
                    target.checked = !target.checked;
                }
            }
            if (target.matches('[data-cart-quantity]')) {
                const quantity = Number(target.value);
                if (!Number.isFinite(quantity) || quantity < 1) {
                    target.value = target.defaultValue || '1';
                    return;
                }
                try {
                    const payload = await requestJson(`/cart/items/${itemId}`, {
                        method: 'PATCH',
                        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': csrfToken() },
                        body: JSON.stringify({ quantity }),
                    });
                    renderCart(payload);
                } catch (error) {
                    setCartFeedback(error.message, 'error');
                    target.value = target.defaultValue || '1';
                }
            }
        });

        cart.itemsContainer.addEventListener('click', async (event) => {
            const button = event.target.closest('[data-cart-remove]');
            if (!button) return;
            const itemCard = button.closest('[data-cart-item-id]');
            if (!itemCard) return;
            const itemId = itemCard.getAttribute('data-cart-item-id');
            try {
                const payload = await requestJson(`/cart/items/${itemId}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': csrfToken() },
                });
                renderCart(payload);
            } catch (error) {
                setCartFeedback(error.message, 'error');
            }
        });
    }

    if (cart.addForm && cart.addSubmit) {
        cart.addForm.addEventListener('submit', async (event) => {
            event.preventDefault();
            setCartFeedback('');
            cart.addSubmit.disabled = true;
            try {
                const payload = await submitCartForm(cart.addForm.action, cart.addForm);
                setCartFeedback('Produk ditambahkan ke keranjang.', 'info');
                openDrawer();
            } catch (error) {
                setCartFeedback(error.message, 'error');
            } finally {
                cart.addSubmit.disabled = false;
            }
        });
    }
}

function initCartDrawer() {
    cart.drawer = document.querySelector('[data-cart-drawer]');
    cart.overlay = document.querySelector('[data-cart-overlay]');
    cart.openButtons = Array.from(document.querySelectorAll('[data-cart-open]'));
    cart.closeButton = document.querySelector('[data-cart-close]');
    cart.itemsContainer = document.querySelector('[data-cart-items]');
    cart.emptyState = document.querySelector('[data-cart-empty]');
    cart.feedback = document.querySelector('[data-cart-feedback]');
    cart.couponForm = document.querySelector('[data-cart-coupon-form]');
    cart.couponMessage = document.querySelector('[data-cart-coupon]');
    cart.notesForm = document.querySelector('[data-cart-notes-form]');
    cart.notesField = document.querySelector('#cartNotes');
    cart.countBadges = Array.from(document.querySelectorAll('[data-cart-count]'));
    cart.countLabel = document.querySelector('[data-cart-count-label]');
    cart.subtotalEl = document.querySelector('[data-cart-subtotal]');
    cart.discountEl = document.querySelector('[data-cart-discount]');
    cart.totalEl = document.querySelector('[data-cart-total]');
    cart.addForm = document.querySelector('[data-cart-add-form]');
    cart.addSubmit = document.querySelector('[data-cart-add-submit]');

    if (!cart.drawer) return;
    bindCartEvents();
    refreshCart();
}

document.addEventListener('DOMContentLoaded', initCartDrawer);
