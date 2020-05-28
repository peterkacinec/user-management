<div id="DeleteModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form id="deleteForm" method="post">
            <div class="modal-content">
                <div class="modal-body">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}
                    <p class="text-center">{{__('user-management::general.Confirmation delete')}}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">{{__('user-management::general.Cancel')}}</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-danger" onclick="formSubmit()">{{__('user-management::general.Yes')}}</button>
                </div>
            </div>
        </form>
    </div>
</div>
<script type="application/javascript">
    function formSubmit()
    {
        jQuery('#deleteForm').submit()
    }
</script>
