    <!-- Delete modal -->
    <div class="modal fade" id="deleteModal-{{ $value->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm">            
          <form action="{{ route($route.'.destroy',$value->id) }}" method="post" class="delete-form">
        @method('delete')
          @csrf
          <input type="hidden" value="{{$value->id}}" name="hidden_id">
            <div class="modal-content">
                <div class="modal-body text-center">
                    <h5 class="modal-title" id="deleteModalLabel">{{ __('modal_are_you_sure') }}</h5>
                    <p class="text-danger mt-2">{{ __('modal_delete_warning') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">{{ __('btn_confirm') }}</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('btn_close') }}</button>
                </div>
            </div><!-- /.modal-content -->
          </form>
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->