

		<div class="modal fade" id="addProductToInvoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title" id="myModalLabel"> Products </h4>
              </div>
              <div class="modal-body" style="overflow-x:hidden;">
                <div style="text-align: center;">
                  <div class="input-prepend">
                    <span class="add-on"> <i class="icon-envel"> Product </i></span>
                    {!! Form::select('product_id', App\ProductName::pluck('name', 'id'), Request::get('product_name') ? Request::get('product_name') : null , ['placeholder' => 'Select Product', 'id' => 'productId' ]) !!}
                    <br>
                    <span class="add-on"> Make </span>
                    <select name="make" id="makeId" >
                      <option value=""> Select Make ... </option>
                    </select>
                    <span class="add-on"> Model </span>
                    <select name="model" id="modelId" >
                      <option value=""> Select Model ... </option>
                    </select>
                  </div>
                </div>
                    <br>
                <table class="table table-hover tablesorter table-bordered">
                    <thead>
                        <tr style="background:#eee;"> 
                        <th> Category </th> 
                        <th> Make <br> </th>
                        <th> Model </th> <th> price </th>
                        <th> Qty </th> 
                        </tr>
                    </thead>
                    <tbody id="productTable">
                        
                    
                    </tbody>
                </table>
             </div>

            </div>
          </div>
       </div>