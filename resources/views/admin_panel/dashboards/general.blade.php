<!-- ============================================================== -->
<!-- Table status widget -->
<!-- ============================================================== -->
<div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12" id="table-status">
    <div class="card">
        <h5 class="card-header">Tables status</h5>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table text-center">
                    <thead class="bg-light">
                    <tr class="border-0">
                        <th class="border-0">#</th>
                        <th class="border-0">Table number</th>
                        <th class="border-0">Status</th>
                        <th class="border-0">Waiter</th>
                        <th class="border-0">Open time</th>
                    </tr>
                    </thead>
                    <tbody  id="tables_status">
                    @include('admin_panel.dashboards.ajax.generalTablesStatus')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End table status  -->
<!-- ============================================================== -->

<!-- ============================================================== -->
<!-- Waiters status widget -->
<!-- ============================================================== -->
<div class="col-xl-3 col-lg-12 col-md-6 col-sm-12 col-12" id="waiters-status">
    <div class="card">
        <h5 class="card-header text-center">Waiters status</h5>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table no-wrap p-table text-center">
                    <thead class="bg-light">
                    <tr class="border-0">
                        <th class="border-0">Name</th>
                        <th class="border-0">Status</th>
                    </tr>
                    </thead>
                    <tbody id="waiters_status_table">

                    @include('admin_panel.dashboards.ajax.generalWaitersStatusTable')

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- ============================================================== -->
<!-- End waiters status widget -->
<!-- ============================================================== -->


