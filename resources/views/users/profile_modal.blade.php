
        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                        <h4 class="modal-title" id="myModalLabel"> Update Your login Details  </h4>
                    </div>
                    <div class="modal-body">
                        <form class="" method="POST" action="{{ route('user.update.login') }}">
                            @csrf
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-envelope"></i></span>
                                <input class="span4" name="email" type="email" placeholder="Email address" required="true">
                            </div>
                            <br>
                            <div class="input-prepend">
                                <span class="add-on"><i class="icon-key"></i></span>
                                <input class="span4" name="password" type="password" placeholder="Password" required>
                            </div>
                    </div>
                    <div class="modal-footer">
                           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                           <button type="submit" class="btn btn-primary"><i class="icon-ok"></i>Save changes</button>
                        </form>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
    </div>


