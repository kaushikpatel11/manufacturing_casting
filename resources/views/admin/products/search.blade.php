<div class="col-md-12 d-flex align-items-stretch grid-margin">
    <div class="row flex-grow">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div id="accordion-2" role="tablist" aria-multiselectable="true" class="accordion">
                        <div class="card">
                            <div class="card-header" role="tab" id="headingOne-2">
                                <h5 class="mb-0">
                                    <a data-toggle="collapse" data-parent="#accordion-2" href="#collapseOne-2" aria-expanded="true" aria-controls="collapseOne-2">
                                    Search
                                    </a>
                                </h2>
                            </div>
                            <div id="collapseOne-2" class="collapse" role="tabpanel" aria-labelledby="headingOne-2">
                                <div class="card-body">
                                    <form class="forms-sample" id="search-frm">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <label>Product Code</label>
                                            <input type="text" name="search_product_code" class="form-control" placeholder="Search Product Code" value="{{ \Request::get("search_product_code") }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label>Title</label>
                                            <input type="text" name="search_title" class="form-control" placeholder="Search Title" value="{{ \Request::get("search_title") }}">
                                        </div>
                                    </div>
                                    <div class="clearfix">&nbsp;</div>
                                    <div class="row" align="center">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-gray mr-2">Search</button>
                                            <a class="btn btn-white" href="{{ $list_url }}">Reset</a>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
  