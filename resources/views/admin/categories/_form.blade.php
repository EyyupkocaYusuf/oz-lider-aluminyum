<div class="admin-field">
    <label for="name" class="admin-label">Kategori Adı</label>
    <input id="name" name="name" type="text" value="{{ old('name', $category?->name ?? '') }}" required class="admin-input" placeholder="Örn. Sürme Sistemleri">
</div>

<label class="admin-toggle-card">
    <span class="admin-toggle-card__text">
        <strong>Aktif</strong>
        <span>Pasif kategoriler ürün filtresinde görünmez.</span>
    </span>
    <span class="admin-toggle">
        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category?->is_active ?? true))>
        <span class="admin-toggle__track"></span>
    </span>
</label>
