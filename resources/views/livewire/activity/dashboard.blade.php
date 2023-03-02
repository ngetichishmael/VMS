<section id="dashboard-ecommerce">
    <section>
        <!-- users filter start -->
        <div class="card">
            <h5 class="card-header">Search Filter</h5>
            <div class="pt-0 pb-2 d-flex justify-content-between align-items-center mx-50 row">
                <div class="col-md-4 user_role">
                    <div class="input-group input-group-merge">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i data-feather="search"></i></span>
                        </div>
                        <input wire:model="search" type="text" id="fname-icon" class="form-control" name="fname-icon"
                            placeholder="Search" />
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="selectSmall">Select Per Page</label>
                        <select class="form-control form-control-sm" id="selectSmall">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="50">50</option>
                            <option value="100">100</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group">
                        <label for="selectSmall">Sort</label>
                        <select class="form-control form-control-sm" id="selectSmall">
                            <option value="1">Ascending</option>
                            <option value="0">Descending</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="pt-0 card-datatable table-responsive">
                <div class="card-datatable table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Target</th>
                                <th>Organization Code</th>
                                <th>Activity</th>
                                <th>Created At</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($activities as $key => $activity)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $activity->target }}</td>
                                    <td>{{ $activity->name }}</td>
                                    <td>{{ $activity->organization }}</td>
                                    <td>{{ $activity->activity }}</td>
                                    <td>{{ now() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center;"> No Record Found </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-1">{{ $activities->links() }}
                    </div>
                </div>
            </div>
    </section>
