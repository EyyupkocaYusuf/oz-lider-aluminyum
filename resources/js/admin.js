/* Admin: toast, delete modal, DataTables */

window.AdminUI = {
    showToast(message, type = 'success', duration = 4000) {
        const host = document.getElementById('admin-toast-host');
        if (!host || !message) {
            return;
        }

        const toast = document.createElement('div');
        toast.className = `admin-toast admin-toast--${type}`;
        toast.setAttribute('role', 'status');
        toast.innerHTML = `
            <span class="admin-toast__icon" aria-hidden="true">${type === 'error' ? this.icons.error : this.icons.success}</span>
            <span class="admin-toast__text">${this.escapeHtml(message)}</span>
        `;

        host.appendChild(toast);
        requestAnimationFrame(() => toast.classList.add('is-visible'));

        window.setTimeout(() => {
            toast.classList.remove('is-visible');
            window.setTimeout(() => toast.remove(), 280);
        }, duration);
    },

    escapeHtml(value) {
        return String(value)
            .replaceAll('&', '&amp;')
            .replaceAll('<', '&lt;')
            .replaceAll('>', '&gt;')
            .replaceAll('"', '&quot;')
            .replaceAll("'", '&#039;');
    },

    icons: {
        success: `<svg viewBox="0 0 24 24" fill="none"><circle cx="12" cy="12" r="10" fill="#22c55e"/><path d="M8 12.5 10.8 15.2 16.2 9.5" stroke="#fff" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"/></svg>`,
        error: `<svg viewBox="0 0 24 24" fill="none"><path d="M12 3.2 21.5 20.2H2.5L12 3.2Z" fill="#ef4444"/><path d="M12 9v5.2" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/><circle cx="12" cy="17.2" r="1.15" fill="#fff"/></svg>`,
    },
};

document.addEventListener('DOMContentLoaded', () => {
    const flash = window.__ADMIN_FLASH__ || {};
    if (flash.success) {
        window.AdminUI.showToast(flash.success, 'success');
    }
    if (flash.error) {
        window.AdminUI.showToast(flash.error, 'error');
    }

    initDeleteModal();
    whenDataTablesReady(initDataTables);
});

function whenDataTablesReady(callback) {
    if (window.jQuery?.fn?.DataTable) {
        callback();
        return;
    }

    window.addEventListener('load', () => {
        if (window.jQuery?.fn?.DataTable) {
            callback();
        }
    });
}

function initDeleteModal() {
    const modal = document.getElementById('admin-delete-modal');
    if (!modal) {
        return;
    }

    const titleEl = modal.querySelector('[data-delete-title]');
    const messageEl = modal.querySelector('[data-delete-message]');
    const confirmBtn = modal.querySelector('[data-delete-confirm]');
    const cancelBtns = modal.querySelectorAll('[data-delete-cancel]');
    let pendingForm = null;

    const open = (form) => {
        pendingForm = form;
        titleEl.textContent = form.dataset.confirmTitle || 'Silme onayı';
        messageEl.textContent = form.dataset.confirmMessage || 'Bu kaydı silmek istediğinize emin misiniz?';
        modal.classList.add('is-open');
        document.body.style.overflow = 'hidden';
    };

    const close = () => {
        pendingForm = null;
        modal.classList.remove('is-open');
        document.body.style.overflow = '';
    };

    document.querySelectorAll('form[data-confirm-delete]').forEach((form) => {
        form.addEventListener('submit', (event) => {
            event.preventDefault();
            open(form);
        });
    });

    cancelBtns.forEach((btn) => btn.addEventListener('click', close));

    modal.addEventListener('click', (event) => {
        if (event.target.classList.contains('admin-modal__backdrop')) {
            close();
        }
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && modal.classList.contains('is-open')) {
            close();
        }
    });

    confirmBtn.addEventListener('click', () => {
        if (!pendingForm) {
            return;
        }

        const form = pendingForm;
        close();
        HTMLFormElement.prototype.submit.call(form);
    });
}

function initDataTables() {
    if (typeof window.jQuery === 'undefined' || !window.jQuery.fn.DataTable) {
        return;
    }

    const $ = window.jQuery;

    document.querySelectorAll('table[data-datatable]').forEach((table) => {
        if ($.fn.DataTable.isDataTable(table)) {
            return;
        }

        const columnCount = table.querySelectorAll('thead th').length;

        $(table).DataTable({
            language: {
                emptyTable: 'Kayıt bulunamadı.',
                info: '_TOTAL_ kayıttan _START_ - _END_ arası gösteriliyor',
                infoEmpty: 'Kayıt yok',
                infoFiltered: '(_MAX_ kayıt içinden filtrelendi)',
                lengthMenu: '_MENU_ kayıt göster',
                loadingRecords: 'Yükleniyor...',
                processing: 'İşleniyor...',
                search: 'Ara:',
                zeroRecords: 'Eşleşen kayıt bulunamadı.',
                paginate: {
                    first: 'İlk',
                    last: 'Son',
                    next: 'Sonraki',
                    previous: 'Önceki',
                },
            },
            pageLength: 10,
            order: [],
            columnDefs: [
                {
                    orderable: false,
                    searchable: false,
                    targets: columnCount - 1,
                },
            ],
        });
    });
}
