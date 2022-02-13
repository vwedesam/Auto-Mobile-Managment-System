

                    <!-- Modal -->
                    <div class="modal fade" id="addNewProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    <h4 class="modal-title" id="myModalLabel">Add New Products</h4>
                                </div>
                                <div class="modal-body">
                                 {!! Form::open([ 'method' => 'POST', 'route' => ['product.store'] ]) !!}

                                    <div class="from-group">
                                        <label for="product_name_id"> Product Category </label>
                                        {!! Form::select('product_name_id', App\ProductName::pluck('name', 'id'), '', ['placeholder' => 'Select Product Category ', 'id' => 'addProductId', 'required' => 'true', 'class' => 'span7' ]) !!}
                                    </div>
                                    <div class="from-group">
                                        <label for="make_id"> Make </label>
                                        <select name="make_id" id="addMakeId" required class="span7" >
                                            <option value=""> Select Make ... </option>
                                        </select>
                                    </div>
                                    <div class="from-group">
                                        <label for="model_id"> Model </label>
                                        <select name="model_id" id="addModelId" required class="span7" >
                                            <option value=""> Select Model ... </option>
                                        </select>
                                    </div>
                                    <div class="from-group">
                                    	<label for="quantity"> Available Quantity/Stock </label>
                                        <input type="number" min="1" name="quantity" class="span7" placeholder="Enter Available Quantity" required >
                                    </div>
                                    <div class="from-group">
                                        <label for="cost"> price </label>
                                        <input type="number" min="1" name="cost" class="span7" placeholder="Enter Product price ..." required >
                                    </div>
                                    <div class="from-group">
                                        <label for="grn"> GRN </label>
                                        <input type="text" name="grn" class="span7" placeholder="Enter GRN ...">
                                    </div>
                                    <div>
                                        <input type="hidden" name="additional_info" class="span7" >
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                                {!! Form::close() !!}
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
              