<div class="admin-product-form space-y-6">
    <div class="grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
        <section class="admin-form-section">
            <h3 class="admin-form-section__title">Katalog Bağlantısı</h3>
            <p class="admin-form-section__hint">Katalog dosyasının bulunduğu bağlantıyı yapıştırın. Ziyaretçiler bu adrese yönlendirilir.</p>

            <div class="admin-field">
                <label for="pdf_link" class="admin-label">Bağlantı (URL)</label>
                <input
                    id="pdf_link"
                    name="pdf_link"
                    type="url"
                    value="{{ old('pdf_link', $catalog?->pdf_link ?? '') }}"
                    required
                    class="admin-input"
                    placeholder="https://ornek.com/katalog.pdf"
                >
            </div>

            @if (!empty($catalog?->pdf_link))
                <a href="{{ $catalog->pdf_link }}" target="_blank" rel="noopener" class="admin-btn-link mt-3 inline-flex">
                    Mevcut bağlantıyı aç →
                </a>
            @endif
        </section>

        <section class="admin-form-section">
            <h3 class="admin-form-section__title">Katalog Bilgileri</h3>
            <p class="admin-form-section__hint">Katalog başlığı ve kodu sitede görüntülenecektir.</p>

            <div class="space-y-4">
                <div class="admin-field">
                    <label for="title" class="admin-label">Katalog Başlığı</label>
                    <input id="title" name="title" type="text" value="{{ old('title', $catalog?->title ?? '') }}" required class="admin-input" placeholder="Örn. Standart Profiller Kataloğu">
                </div>

                <div class="admin-field">
                    <label for="code" class="admin-label">Katalog Kodu</label>
                    <input id="code" name="code" type="text" value="{{ old('code', $catalog?->code ?? '') }}" required class="admin-input" placeholder="Örn. SP-2026">
                </div>
            </div>
        </section>
    </div>

    <div class="admin-form-actions">
        <a href="{{ route('admin.catalogs.index') }}" class="admin-btn-secondary">İptal</a>
        <button type="submit" class="admin-btn-primary px-6 py-2.5">
            {{ isset($catalog) ? 'Değişiklikleri Kaydet' : 'Kataloğu Kaydet' }}
        </button>
    </div>
</div>
