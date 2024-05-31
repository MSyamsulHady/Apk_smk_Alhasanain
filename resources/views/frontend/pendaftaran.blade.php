@extends('layout.landing')
@section('content')
<div class="breadcrumbs">
    <div class="container">
      <h2>FORM PENDAFTARAN</h2>
      <p>Est dolorum ut non facere possimus quibusdam eligendi voluptatem. Quia id aut similique quia voluptas sit quaerat debitis. Rerum omnis ipsam aperiam consequatur laboriosam nemo harum praesentium. </p>
    </div>
</div>
<section id="trainers" class="trainers">
    <div class="container" data-aos="fade-up">

      <div class="row" data-aos="zoom-in" data-aos-delay="100">
        <div class="col-lg-12 col-md-12 d-flex align-items-stretch">
            <form class="row g-3">
                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label">Nama</label>
                  <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                  <label for="inputPassword4" class="form-label">Tanggal Lahir</label>
                  <input type="password" class="form-control" id="inputPassword4">
                </div>
                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label"> No Hp</label>
                  <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                  <label for="inputPassword4" class="form-label">Alamat</label>
                  <input type="password" class="form-control" id="inputPassword4">
                </div>
                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label">Email</label>
                  <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                  <label for="inputPassword4" class="form-label">jurusan</label>
                  <input type="password" class="form-control" id="inputPassword4">
                </div>
                <div class="col-md-6">
                  <label for="inputEmail4" class="form-label">dkk</label>
                  <input type="email" class="form-control" id="inputEmail4">
                </div>
                <div class="col-md-6">
                  <label for="inputPassword4" class="form-label">DKK</label>
                  <input type="password" class="form-control" id="inputPassword4">
                </div>
                <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </div>
              </form>
        </div>
      </div>

    </div>
  </section>
@endsection
