<div class="admin-product-form space-y-6">
    <div class="grid gap-6 lg:grid-cols-[0.95fr_1.05fr]">
        <section class="admin-form-section">
            <h3 class="admin-form-section__title">Ürün Görseli</h3>
            <p class="admin-form-section__hint">PNG, JPG veya WEBP yükleyin. Önerilen boyut: 1200×900 px.</p>

            <div class="admin-upload-zone" data-image-upload>
                <div class="admin-upload-zone__preview" data-image-preview>
                    @if (!empty($product?->image_url))
                        <img src="{{ $product->image_url }}" alt="{{ $product->title }}" data-image-preview-img>
                        <p class="admin-upload-zone__sub">Yeni görsel seçmek için tıklayın veya sürükleyin</p>
                    @else
                        <span class="admin-upload-zone__icon" data-image-placeholder>
                            <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" aria-hidden="true">
                                <path d="M12 16V4m0 0 4-4m-4 4 4 4M4 18v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2v-2" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/>
                            </svg>
                        </span>
                        <p class="admin-upload-zone__label" data-image-placeholder>Görsel yükleyin</p>
                        <p class="admin-upload-zone__sub" data-image-placeholder>Dosyayı sürükleyin veya seçmek için tıklayın</p>
                    @endif
                </div>
                <input id="image" name="image" type="file" accept="image/*">
            </div>
        </section>

        <div class="space-y-6">
            <section class="admin-form-section">
                <h3 class="admin-form-section__title">Temel Bilgiler</h3>
                <p class="admin-form-section__hint">Ürünün sitede görünecek adını ve kategorisini belirleyin.</p>

                <div class="space-y-4">
                    <div class="admin-field">
                        <label for="category_id" class="admin-label">Kategori</label>
                        <select id="category_id" name="category_id" class="admin-select">
                            <option value="">Kategori seçin</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id', $product?->category_id ?? '') == $category->id)>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="admin-field">
                        <label for="title" class="admin-label">Ürün Adı</label>
                        <input id="title" name="title" type="text" value="{{ old('title', $product?->title ?? '') }}" required class="admin-input" placeholder="Örn. Sürme Sistem Profili">
                    </div>
                </div>
            </section>

            <section class="admin-form-section">
                <h3 class="admin-form-section__title">Yayın Ayarları</h3>
                <p class="admin-form-section__hint">Ürünün sitede nerede ve nasıl görüneceğini seçin.</p>

                <div class="space-y-3">
                    <label class="admin-toggle-card">
                        <span class="admin-toggle-card__text">
                            <strong>Ana sayfada göster</strong>
                            <span>Öne çıkan ürünler bölümünde listelenir.</span>
                        </span>
                        <span class="admin-toggle">
                            <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product?->is_featured ?? false))>
                            <span class="admin-toggle__track"></span>
                        </span>
                    </label>

                    <label class="admin-toggle-card">
                        <span class="admin-toggle-card__text">
                            <strong>Aktif</strong>
                            <span>Pasif ürünler sitede görünmez.</span>
                        </span>
                        <span class="admin-toggle">
                            <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product?->is_active ?? true))>
                            <span class="admin-toggle__track"></span>
                        </span>
                    </label>
                </div>
            </section>
        </div>
    </div>

    <div class="admin-form-actions">
        <a href="{{ route('admin.products.index') }}" class="admin-btn-secondary">İptal</a>
        <button type="submit" class="admin-btn-primary px-6 py-2.5">
            {{ isset($product) ? 'Değişiklikleri Kaydet' : 'Ürünü Kaydet' }}
        </button>
    </div>
</div>
