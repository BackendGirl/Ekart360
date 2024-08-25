<div class="form-group">
            <label for="photo" class="col-form-label">Photos</label><br>
            @if($data->photos != null && $data->photos !='')
                <ul>
                @foreach(explode(',', $data->photos) as $key=>$subphotos)                       
                @php $catid = trim($subphotos,'[]"'); @endphp  
                @if($catid != '' && strlen($catid) > 1)
                    <li class="multi_image_list">
                        <input type="checkbox" id="myCheckbox{{$key}}" name="photos[]" value="{{$catid}}" />
                        <label for="myCheckbox{{$key}}"><img src="{{URL::to($catid)}}" /></label>
                    </li>     
                    @endif                               
                @endforeach    
                </ul>
                <input type="hidden" class="form-control" id="" name="hidden_photos" value="{{$data->photos}}"> 
            @endif  
            <input type="file" class="form-control" id="photo" name="photos[]" multiple>
            @error('photo')
            <span class="text-danger">{{$message}}</span>
            @enderror

        </div>

        <style>
    ul {
  list-style-type: none;
}

.multi_image_list {
  display: inline-block;
}

input[type="checkbox"][id^="myCheckbox"] {
  display: none;
}

label {
  border: 1px solid #fff;
  padding: 10px;
  display: block;
  position: relative;
  margin: 10px;
  cursor: pointer;
}

label:before {
  background-color: white;
  color: white;
  content: " ";
  display: block;
  border-radius: 50%;
  border: 1px solid grey;
  position: absolute;
  top: -5px;
  left: -5px;
  width: 25px;
  height: 25px;
  text-align: center;
  line-height: 28px;
  transition-duration: 0.4s;
  transform: scale(0);
}

label img {
  height: 100px;
  width: 100px;
  transition-duration: 0.2s;
  transform-origin: 50% 50%;
}

:checked + label {
  border-color: #ddd;
}

:checked + label:before {
  content: "✓";
  background-color: grey;
  transform: scale(1);
}

:checked + label img {
  transform: scale(0.9);
  /* box-shadow: 0 0 5px #333; */
  z-index: -1;
}
</style>