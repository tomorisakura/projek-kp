{{!! Form::model($pelanggan, [
    'route' => $pelanggan->exists ? ['store.penitipan', $pelanggan->id] : 'store',
    'method' => 'post'
])!!}}

<div>
    <div class="form-group row">
        <label class="col-sm-2 col-form-label">Nama Pemilik</label>
        <div class="col-sm-10">
        {{!! Form::text('nama_pemilik', null, ['class' => 'form-control', 'id' => '_pemilik']) !!}}
        </div>
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Alamat</label>
    <div class="col-sm-10">
        {{!! Form::text('alamat', null, ['class' => 'form-control', 'id' => '_alamat']) !!}}
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Nomor Handphone</label>
    <div class="col-sm-10">
        {{!! Form::number('no_hp', null, ['class' => 'form-control', 'id' => '_nohp']) !!}}
    </div>
</div>

<div class="form-group row">
    <label class="col-sm-2 col-form-label">Email</label>
    <div class="col-sm-10">
        {{!! Form::email('email', null, ['class' => 'form-control', 'id' => '_alamat']) !!}}
    </div>
</div>

{{!! Form::close() !!}}