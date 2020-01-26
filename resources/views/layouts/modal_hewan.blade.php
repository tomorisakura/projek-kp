<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Hewan Peliharaan</h6>
</div>

<div class="form-group row">
<label class="col-sm-2 col-form-label">Nama Hewan</label>
<div class="col-sm-10">
    <input type="text" name="nama_hewan" class="form-control" id="_hewan" autocomplete="off">
</div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Jenis Kelamin</label>
    <div class="col-sm-10">
        <input type="radio" name="jk_hewan" value="Jantan"> Jantan
        <input type="radio" name="jk_hewan" value="Betina"> Betina
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Ras</label>
    <div class="col-sm-10">
    <select class="form-control" name="ras_hewan" required>
        <option>--Pilih--</option>
        <option value="Domestic">Domestic</option>
        <option value="Persia">Persia</option>
        <option value="Anggora">Anggora</option>
        <option value="Munchkin">Munchkin</option>
        <option value="Mainecoon">Mainecoon</option>
        <option value="Rusian Blue">Rusian Blue</option>
        <option value="lain_lain">Lain - Lain</option>
    </select>
    </div>
</div>