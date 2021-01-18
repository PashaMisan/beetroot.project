<div class="row">
    <!-- ============================================================== -->
    <!-- recent orders  -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-6 col-sm-12 col-12">
        <div class="card">
            <div class="card-header d-flex">
                <h5 class="mb-0">My tables</h5>
                <div class="dropdown ml-auto">
                    <a class="toolbar text-success" href="#" role="button" data-toggle="modal"
                       aria-haspopup="true" aria-expanded="false" data-target="#modal">
                        <i class="fas fa-plus"></i> OPEN TABLE</a>

                    <!-- Modal -->
                    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="ModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="ModalLabel">Modal title</h5>
                                    <a href="#" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </a>
                                </div>

                                <form action="{{ route('open_table') }}" method="post">
                                    @csrf
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="input-select">Choose the required table</label>
                                            <select class="form-control" id="input-select" name="table_id" >
                                                @foreach($freeTables as $table)
                                                    <option value="{{ $table->id }}">{{ $table->number }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">Open</button>
                                        <a href="#" class="btn btn-secondary" data-dismiss="modal">Cancel</a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
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
                            <th class="border-0">Action</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($waiterTables as $key => $table)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $table->number  }}</td>


                                <td>
                                                    <span class="mr-2">
                                                        <span class="badge-dot badge-success"></span>
                                                        Active
                                                    </span></td>
                                <td>{{ $table->getWaiterName()}}</td>
                                <td>{{ $table->order->created_at }}</td>
                                <td>
                                    <a href="{{ route('close_table', ['id' => $table->id]) }}"
                                       class="btn btn-outline-danger">Close</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end recent orders  -->
    <!-- ============================================================== -->
</div>


