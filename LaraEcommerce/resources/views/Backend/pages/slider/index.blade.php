@extends('Backend.layouts.master')
@section('content')
<div class="main-panel">
        <div class="content-wrapper">
        <div class="card">
          <div class="card-header">Manage Sliders</div>
        <div class="card-body">

           @include('Backend.partials.message')  {{-- display message --}}

           <a href="#addSliderModal" data-toggle="modal" class="btn btn-info float-right mb-2">
              <i class="fa fa-plus"></i>Add New Slider
           </a>

           <div class="clearfix"></div>
                <!-- Modal starts for add slider-->
                <div class="modal fade" id="addSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add New Slider</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('admin.slider.store') }}" method="post" enctype="multipart/form-data">
                         @csrf

                         <div class="form-group">
                          <label for="title">Slider Title <small class="text-danger">(required)</small></label>
                          <input type="text" class="form-control" name="title" id="title" placeholder="Slider Title" required>
                         </div>

                         <div class="form-group">
                          <label for="image">Slider Image <small class="text-danger">(required)</small></label>
                          <input type="file" class="form-control" name="image" id="image" placeholder="Slider Image" required>
                         </div>

                         <div class="form-group">
                          <label for="button_text">Slider Button Text <small class="text-info">(Optional)</small></label>
                          <input type="text" class="form-control" name="button_text" id="button_text" placeholder="Slider Button Text(if need)">
                         </div>

                         <div class="form-group">
                          <label for="button_link">Slider Button Link <small class="text-info">(Optional)</small></label>
                          <input type="url" class="form-control" name="button_link" id="button_link" placeholder="Slider Button Link(if need)">
                         </div>

                         <div class="form-group">
                          <label for="priority">Slider Priority <small class="text-danger">(required)</small></label>
                          <input type="number" class="form-control" name="priority" id="priority" placeholder="Slider Priority; e.g:10" value="1" required>
                         </div>

                         <button type="submit" class="btn btn-outline-info">Add Slider</button>                
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>                       
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal ends -->

        <table class="table table-hover table-striped">
          <tr class="">
            <th>#</th>
            <th>Slider Title</th>
            <th>Slider Image</th>
            <th>Slider Priority</th>
            <th>Action</>
          </tr>

           @foreach ($sliders as $slider)          
             <tr class="">
               <td>{{$loop->iteration}}</td>
               <td>{{ $slider->title}}</td>
               <td><img src="{{ asset('images/sliders/'.$slider->image)}}" width="50"></td>
               <td>{{ $slider->priority }}</td>
               <td>
                <a href="#editModal{{$slider->id}}" data-toggle="modal" class="btn btn-outline-info">Edit</a>
                
                <a href="#deleteModal{{$slider->id}}" data-toggle="modal" class="btn btn-outline-danger">Delete</a>


                <!-- Modal starts for delete -->
                <div class="modal fade" id="deleteModal{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Are you sure to delete?</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>

                      <div class="modal-body">
                        <form action="{{ route('admin.slider.delete',$slider->id) }}" method="post">
                         @csrf
                         <button type="submit" class="btn btn-outline-danger">Permanent Delete</button>                
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>                       
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal ends -->

                <!-- Modal starts for edit slider-->
                <div class="modal fade" id="editModal{{$slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Update Slider</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="{{ route('admin.slider.update',$slider->id) }}" method="post" enctype="multipart/form-data">
                         @csrf

                         <div class="form-group">
                          <label for="title">Slider Title <small class="text-danger">(required)</small></label>
                          <input type="text" class="form-control" name="title" id="title" placeholder="Slider Title" value="{{ $slider->title}}" required>
                         </div>

                         <div class="form-group">
                          <label for="image">Slider Image 
                          <a href="{{ asset('images/sliders/'.$slider->image)}}" target="_blank">Previous Image</a>
                          <small class="text-danger"></small></label>
                          <input type="file" class="form-control" name="image" id="image" placeholder="Slider Image">
                         </div>

                         <div class="form-group">
                          <label for="button-text">Slider Button Text <small class="text-info">(Optional)</small></label>
                          <input type="text" class="form-control" name="button_text" id="button_text" placeholder="Slider Button Text(if need)" value="{{ $slider->button_text}}">
                         </div>

                         <div class="form-group">
                          <label for="button-link">Slider Button Link <small class="text-info">(Optional)</small></label>
                          <input type="url" class="form-control" name="button_link" id="button_link" placeholder="Slider Button Link(if need)" value="{{ $slider->button_link}}">
                         </div>

                         <div class="form-group">
                          <label for="priority">Slider Priority <small class="text-danger">(required)</small></label>
                          <input type="number" class="form-control" name="priority" id="priority" placeholder="Slider Priority; e.g:10" value="{{ $slider->priority}}" required>
                         </div>

                         <button type="submit" class="btn btn-outline-info">Update Slider</button>                
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>                       
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Modal ends -->



               </td>
             </tr>
          

           @endforeach
           
          
        </table>
       
        </div> 
        </div>            
          </div>
      </div>

@endsection      
