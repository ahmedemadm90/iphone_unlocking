
<!-- ROW-1 -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                <div class="card overflow-hidden">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="mt-2">
                                <h6 class="">Total Clients</h6>
                                <h2 class="mb-0 number-font">{{App\Models\User::where('role_id',2)->count()}}</h2>
                            </div>
                            <div class="ms-auto">
                                <div class="chart-wrapper mt-1">
                                    <canvas id="saleschart" class="h-8 w-9 chart-dropshadow"></canvas>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ROW-1 END -->
