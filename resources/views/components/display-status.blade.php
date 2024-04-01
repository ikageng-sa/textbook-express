@props(['status' =>false, 'message' => ''])
<div class="alert {{ ($status) ? 'alert-success' : 'alert-warning' }} alert-dismissible fade show col-sm-12 col-md-4 col-lg-3 fw-bold" role="alert" style="z-index:999;position:absolute;top:90%;left:50%;-ms-transform: translate(-50%, -50%);transform: translate(-50%, -50%);">
    {{ $message }}
  <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
</div>