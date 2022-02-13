          

          <div class="modal fade" id="addMisToInvoice" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel"> Miscellaneous </h4>
                    </div>
                    <div class="modal-body">
                      <div style="text-align: center;">
                          <div class="input-prepend">
                              <span class="add-on"> <i class="icon-envel"> Search </i></span>
                              <input type="text" name="search_misc"
                              id="searchMisc" placeholder="enter search here ...">
                          </div>
                        </div>
                        <br>
                      <table class="table table-hover tablesorter table-bordered">
                        <thead>
                          <tr style="background:#eee;"> 
                          <th> # </th> <th> Name  </th> 
                          <th> Make <br> </th>
                          <th> Model/Description </th>
                          <th> Price </th> <th>Qty</th>
                          </tr>
                        </thead>
                        <tbody id="miscTable">
                            
                        
                        </tbody>
                      </table>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>