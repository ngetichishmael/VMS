@if ($message = Session::get('success'))

         <!--Closable Alerts start -->
         <section id="alerts-closable">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                   
                        <div class="card-body">
                     
                          <div class="demo-spacing-0">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                              <div class="alert-body">
                              <i data-feather="star"></i>
                              {{ $message }}
                              </div>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!--Closable Alerts end -->


@endif
  
@if ($message = Session::get('error'))
         <!--Closable Alerts start -->
         <section id="alerts-closable">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                   
                        <div class="card-body">
                     
                          <div class="demo-spacing-0">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <div class="alert-body">
                              <i data-feather="star"></i>
                              {{ $message }}
                              </div>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!--Closable Alerts end -->
@endif
   
@if ($message = Session::get('warning'))
         <!--Closable Alerts start -->
         <section id="alerts-closable">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                   
                        <div class="card-body">
                     
                          <div class="demo-spacing-0">
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                              <div class="alert-body">
                              <i data-feather="star"></i>
                              {{ $message }}
                              </div>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!--Closable Alerts end -->
@endif
   
@if ($message = Session::get('info'))
         <!--Closable Alerts start -->
         <section id="alerts-closable">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                   
                        <div class="card-body">
                     
                          <div class="demo-spacing-0">
                            <div class="alert alert-block alert-dismissible fade show" role="alert">
                              <div class="alert-body">
                              <i data-feather="star"></i>
                              {{ $message }}
                              </div>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!--Closable Alerts end -->
@endif
  
@if ($errors->any())
         <!--Closable Alerts start -->
         <section id="alerts-closable">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                   
                        <div class="card-body">
                     
                          <div class="demo-spacing-0">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                              <div class="alert-body">
                              <i data-feather="star"></i>
                              {{ $message }}
                              </div>
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
                <!--Closable Alerts end -->
@endif