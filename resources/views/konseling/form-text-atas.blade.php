<style>
    .container {
        display: flex;
        flex-wrap: wrap;
        gap: 15px; /* space between items */
    }
    .form-item {
        flex: 1 1 calc(33.33% - 20px); /* 3 items per row with gap */
        display: flex;
        flex-direction: column;
    }
    .form-item label {
        font-size: 0.9em;
        color: #555;
        margin-bottom: 5px;
    }
    .form-item input {
        padding: 5px;
        font-size: 1em;
        border: 1px solid #ccc;
        border-radius: 4px;
    }
</style>

<h5 class="text-primary">Riwayat Perjalanan Kasus</h5>
<div class="container">
    <div class="form-item">
        <label>Keluhan <span class="text-danger">*</span> </label>
        <input type="text" placeholder="keluhan saat ini" id="keluhan" name="keluhan" required>
    </div>
    <div class="form-item">
        <label>Riwayat Kasus</label>
        <input type="text" placeholder="*jika ada" id="riwayat_kasus" name="riwayat_kasus">
    </div>
</div>
<br>
<h5 class="text-primary">Dinamika Psikologi</h5>
<div class="container">
    <div class="form-item">
        <label>Asesmen </label>
        <textarea id="asesmen" name="asesmen" placeholder="isi asesmen"></textarea>
    </div>
    <div class="form-item">
        <label>Dinamika Psikologi </label>
        <textarea id="dinamika_psikologi" name="dinamika_psikologi" placeholder="isi dinamika psikologi"></textarea>
    </div>
    <div class="form-item">
        <label>Prioritas Intervensi </label>
        <textarea id="prioritas_intervensi" name="prioritas_intervensi" placeholder="prioritas intervensi yang ditetapkan"></textarea>
    </div>
</div>
<br>
<h5 class="text-primary">Intervensi</h5>
<div class="container">
    <div class="form-item">
        <label>Intervensi <span class="text-danger">*</span> </label>
        <input type="text" placeholder="intervensi yang perlu dilakukan" id="intervensi" name="intervensi">
    </div>
    <div class="form-item">
        <label>Rencana Intervensi Lanjutan</label>
        <input type="text" placeholder="*jika ada" id="rencana_intervensi_lanjutan" name="rencana_intervensi_lanjutan">
    </div>
</div>
