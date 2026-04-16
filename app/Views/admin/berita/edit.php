<form method="POST"
      action="<?= base_url('admin/berita/update/'.$berita['id_berita']) ?>"
      enctype="multipart/form-data">

<input type="text"
       name="judul_berita"
       value="<?= esc($berita['judul_berita']) ?>"
       class="form-control">

<textarea name="deskripsi_berita"
          id="deskripsi"
          class="form-control"><?= $berita['deskripsi_berita'] ?></textarea>

<select name="status_berita" class="form-select">
    <option value="Publish"
        <?= $berita['status_berita'] == 'Publish' ? 'selected' : '' ?>>
        Publish
    </option>
    <option value="Unpublish"
        <?= $berita['status_berita'] == 'Unpublish' ? 'selected' : '' ?>>
        Unpublish
    </option>
</select>

<?php if (!empty($berita['gambar_berita'])) : ?>
    <img src="<?= base_url('uploads/berita/'.$berita['gambar_berita']) ?>" width="180">
<?php endif; ?>

<input type="file" name="gambar_berita" class="form-control">

<button type="submit" class="btn btn-primary">Simpan Perubahan</button>

</form>