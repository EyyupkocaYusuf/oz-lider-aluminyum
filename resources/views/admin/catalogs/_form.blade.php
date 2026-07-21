<div class="admin-product-form space-y-6">
    <div class="grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
        <section class="admin-form-section">
            <h3 class="admin-form-section__title">PDF Dosyası</h3>
            <p class="admin-form-section__hint">Katalog PDF dosyasını yükleyin. Maksimum dosya boyutu: 10 MB.</p>

            <div class="admin-upload-zone admin-upload-zone--pdf" data-pdf-upload>
                <div class="admin-upload-zone__preview" data-pdf-preview>
                    @if (!empty($catalog?->pdf_path))
                        <span class="admin-upload-zone__icon">
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M6 4h9l3 3v13H6V4Zm9 0v3h3" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <p class="admin-upload-zone__label">Mevcut PDF yüklü</p>
                        <p class="admin-upload-zone__sub" data-pdf-filename>{{ $catalog->title }}.pdf</p>
                        <p class="admin-upload-zone__sub">Yeni dosya seçmek için tıklayın veya sürükleyin</p>
                    @else
                        <span class="admin-upload-zone__icon" data-pdf-placeholder>
                            <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M6 4h9l3 3v13H6V4Zm9 0v3h3M8.5 12h7M8.5 16h7" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <p class="admin-upload-zone__label" data-pdf-placeholder>PDF yükleyin</p>
                        <p class="admin-upload-zone__sub" data-pdf-placeholder>Dosyayı sürükleyin veya seçmek için tıklayın</p>
                    @endif
                </div>
                <input id="pdf" name="pdf" type="file" accept="application/pdf" @if(empty($catalog)) required @endif>
            </div>
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
