<!DOCTYPE html>
<html>
  <head> 
   @include('admin.css')
   <style>
    /* រៀបចំ Container ធំ */
    .form_container {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 0;
    }

    /* រៀបចំកាតព័ទ្ធជុំវិញ Form */
    .card_design {
        background-color: #2d3035;
        border-radius: 12px;
        padding: 40px;
        width: 500px; /* កំណត់ទំហំឲ្យល្មមមើល */
        box-shadow: 0 10px 25px rgba(0,0,0,0.3);
    }

    .card_design h1 {
        font-size: 24px;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 30px;
        text-align: center;
        border-bottom: 1px solid #444;
        padding-bottom: 15px;
    }

    /* រៀបចំ Group នីមួយៗ */
    .div_deg {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column; /* ដាក់ Label នៅលើ Input */
    }

    label {
        color: #d1d1d1;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 500;
    }

    /* រចនា Input, Textarea, Select */
    input[type='text'], 
    input[type='number'], 
    textarea, 
    select {
        background-color: #34373d;
        border: 1px solid #4b4f56;
        border-radius: 6px;
        padding: 12px;
        color: #fff;
        font-size: 15px;
        transition: all 0.3s;
    }

    input:focus, textarea:focus, select:focus {
        border-color: #db6574; /* ប្តូរពណ៌ពេល Click */
        outline: none;
        box-shadow: 0 0 5px rgba(219, 101, 116, 0.3);
    }

    /* ប៊ូតុង Add Room */
    .btn_submit {
        background-color: #db6574;
        color: white;
        border: none;
        padding: 14px;
        border-radius: 6px;
        font-size: 16px;
        font-weight: bold;
        cursor: pointer;
        width: 100%; /* ឲ្យប៊ូតុងវែងពេញកាត */
        margin-top: 10px;
        transition: 0.3s ease;
    }

    .btn_submit:hover {
        background-color: #c05260;
        transform: translateY(-2px); /* ឲ្យវាអណ្តែតបន្តិចពេលដាក់ Mouse លើ */
    }

    /* ប៊ូតុងរើសរូបភាព */
    input[type='file'] {
        color: #888;
        padding-top: 5px;
    }
</style>
  </head>
   <body>   
   @include('admin.header')   
   @include('admin.sidebar')   
   <div class="page-content">    
    <div class="page-header">     
     <div class="container-fluid">      
      <div class="form_container">       
       <div class="card_design">        
        <h1>Add New Room</h1>        

        {{-- 🔥 SUCCESS MESSAGE --}}        
        @if(session('success'))            
            <div style="background:green; color:white; padding:10px; border-radius:6px; margin-bottom:15px; text-align:center;">                
                {{ session('success') }}            
            </div>        
        @endif        

        <form action="{{url('store_room')}}" method="Post" enctype="multipart/form-data">            
            @csrf            
            
            <div class="div_deg">                
                <label>Room Title</label>                
                <input type="text" name="room_title" value="{{old('room_title')}}" placeholder="e.g. Deluxe Ocean View">
                @error('room_title') 
                    <span style="color:#db6574; font-size:13px;">{{$message}}</span> 
                @enderror
            </div>            

            <div class="div_deg">                
                <label>Description</label>                
                <textarea name="description" rows="3" placeholder="Enter room details...">{{old('description')}}</textarea>
                @error('description') 
                    <span style="color:#db6574; font-size:13px;">{{$message}}</span> 
                @enderror
            </div>            

            <div class="div_deg">                
                <label>Price ($)</label>                
                <input type="number" name="price" value="{{old('price')}}" placeholder="Enter price">
                @error('price') 
                    <span style="color:#db6574; font-size:13px;">{{$message}}</span> 
                @enderror
            </div>            

            <div class="div_deg">                
                <label>Room Type</label>                
                <select name="room_type">                    
                    <option value="regular" {{old('room_type') == 'regular' ? 'selected' : ''}}>Regular</option>                    
                    <option value="premium" {{old('room_type') == 'premium' ? 'selected' : ''}}>Premium</option>                    
                    <option value="deluxe" {{old('room_type') == 'deluxe' ? 'selected' : ''}}>Deluxe</option>                
                </select>            
            </div>            

            <div class="div_deg">                
                <label>Free Wi-Fi</label>                
                <select name="wifi">                    
                    <option value="1" {{old('wifi') == '1' ? 'selected' : ''}}>Yes</option>                    
                    <option value="0" {{old('wifi') == '0' ? 'selected' : ''}}>No</option>                
                </select>            
            </div>            

            <div class="div_deg">                
                <label>Room Image</label>                
                <input type="file" name="image">
                @error('image') 
                    <span style="color:#db6574; font-size:13px;">{{$message}}</span>
                @enderror
            </div>            

            <div class="div_deg">                
                <input class="btn_submit" type="submit" value="Add Room">            
            </div>        
        </form>       
       </div>      
      </div>     
     </div>    
    </div>   
   </div>   
   @include('admin.footer')  
  </body>
</html>