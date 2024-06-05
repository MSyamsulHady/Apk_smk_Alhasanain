  @props(['title'=>false ,'id'=> false,'class-modal'=>false])

  @php
  $class = $classModal ?? ' modal-lg modal-dialog-scrollable';
  @endphp

  <div class="modal fade" id="{{$id}}" role="dialog" tabindex="-1" aria-hidden="true">
      <div {{$attributes->merge(['class'=>'modal-dialog'.$class])}} role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">{{$title}}</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                  {{$slot}}
              </div>
          </div>
      </div>
  </div>