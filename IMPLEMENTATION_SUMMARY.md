# Survey Perencanaan BOK - Update Summary

## Completed Changes

### 1. Database Schema Simplified
- **Migration 1**: `2025_12_23_000001_update_usulans_simplify_and_rename_columns.php`
  - Removed columns: `volume`, `volume_satuan`, `frekuensi_tahun`, `output`, `output_satuan`, `anggaran`
  - Renamed: `saran_kegiatan` → `rincian_menu`
  - Renamed: `keriteria_penerima_bok` → `sasaran_rincian_menu`

- **Migration 2**: `2025_12_23_000002_create_usulan_reactions_table.php`
  - New table: `usulan_reactions` with fields:
    - `id`, `usulan_id`, `responden_id`, `reaction` (enum: like/dislike)
    - Unique constraint on `(usulan_id, responden_id)` to prevent duplicates

### 2. Models Updated

**Usulan.php**
- Updated `$fillable` array with new field names
- Removed numeric casts for deleted columns
- Added relationship: `reactions()` → hasMany(UsulanReaction)

**UsulanReaction.php** (new)
- Relationships: belongsTo(Usulan), belongsTo(Responden)
- Stores user reactions (like/dislike) per usulan

### 3. Controller Logic Enhanced

**UsulanController.php**
- `store()` method: Updated field names in validation & creation
- `rekap()` method: 
  - Added `withCount(['reactions as likes_count', 'reactions as dislikes_count'])`
  - Implemented sorting: `sort=like|dislike|terbaru|terlama` (default: terbaru)
  - Passes counts to view
- `react()` method (new):
  - POST `/usulan/{id}/react`
  - Session check: Returns 403 if user hasn't filled survey
  - Updates/creates reaction record
  - Returns JSON: `{likes: int, dislikes: int}`

### 4. Routes Added

```php
Route::post('/usulan/{id}/react', [UsulanController::class, 'react'])->name('usulan.react');
```

### 5. Views Updated

**form.blade.php**
- Input field renamed: `saran_kegiatan` → `rincian_menu`
- Input field renamed: `keriteria_penerima_bok` → `sasaran_rincian_menu`
- Removed inputs: volume, satuan, frekuensi_tahun, anggaran
- Table updated to show only relevant columns

**rekap.blade.php**
- Statistic: "Anggaran" → "Like" (total likes count)
- Added sort dropdown: Terbaru, Terlama, Like terbanyak, Dislike terbanyak
- Updated data attributes to use new field names
- Like/Dislike buttons added with counts (👍 👎)
- AJAX handler: checks session; sends reaction POST; updates counts dynamically
- Alert if user hasn't filled survey before liking/disliking

**rekap-table.blade.php**
- Removed columns: Volume, Frekuensi, Anggaran
- Renamed columns: "Saran Kegiatan" → "Rincian Menu", "Kriteria BOK" → "Sasaran Rincian Menu"
- Added columns: Like count, Dislike count
- Statistic: "Total Anggaran" → "Total Like"

## How It Works

### User Survey Flow
1. User fills data responden (name, instansi, jabatan)
   - Session sets `responden_id`
2. User adds usulan by filling:
   - Indikator, Tingkat, Rincian Menu, Detail Kegiatan, Sasaran Rincian Menu
   - (Simpler form - no volume/anggaran)
3. User views rekap survey with like/dislike feature
   - If not a responden (no session): Click like/dislike → Alert
   - If responden: Click like/dislike → AJAX POST to `/usulan/{id}/react`
   - Count updates immediately
4. Admin can sort by likes, dislikes, newest, oldest

### Like/Dislike Logic
- Only 1 reaction per responden per usulan (unique constraint)
- Clicking like/dislike toggles between them (updateOrCreate)
- Anyone can **view** reactions, but only survey respondents can **create** them

## Testing Checklist

✅ Migrations run successfully  
✅ Models created & working  
✅ Controller routes functional  
✅ Views use new field names  
✅ Like/Dislike UI integrated  

## Next: Local Testing

```bash
# Start Laravel dev server
php artisan serve

# Visit in browser
http://localhost:8000

# Test flow:
# 1. Fill responden data
# 2. Add usulan with new fields
# 3. Click like/dislike buttons (should update counts via AJAX)
# 4. Visit rekap, use sort dropdown
# 5. Test without responden session (alert should show)
```

## Notes

- No migrations/rollback needed if staying on new schema
- Reactions can be cleared via: `php artisan tinker` → `UsulanReaction::truncate()`
- Like/Dislike counts auto-calculate using withCount()
- Sorting default is "terbaru" (newest first)
