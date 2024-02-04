@props(['day','time'=>'noon','data' => []])
<div class="input-group">
    <span class="input-group-text">از</span>
    <select class="form-select" type="text" id="{{$day}}_{{$time}}_start" name="{{$day}}[{{$time}}][start]">
         <option selected="selected"></option>
         <option {{($data['start'] ?? '') == '12:00' ? 'selected' : ''}}>12:00</option>
         <option {{($data['start'] ?? '') == '12:15' ? 'selected' : ''}}>12:15</option>
         <option {{($data['start'] ?? '') == '12:30' ? 'selected' : ''}}>12:30</option>
         <option {{($data['start'] ?? '') == '12:45' ? 'selected' : ''}}>12:45</option>
         <option {{($data['start'] ?? '') == '13:00' ? 'selected' : ''}}>13:00</option>
         <option {{($data['start'] ?? '') == '13:15' ? 'selected' : ''}}>13:15</option>
         <option {{($data['start'] ?? '') == '13:30' ? 'selected' : ''}}>13:30</option>
         <option {{($data['start'] ?? '') == '13:45' ? 'selected' : ''}}>13:45</option>
         <option {{($data['start'] ?? '') == '14:00' ? 'selected' : ''}}>14:00</option>
         <option {{($data['start'] ?? '') == '14:15' ? 'selected' : ''}}>14:15</option>
         <option {{($data['start'] ?? '') == '14:30' ? 'selected' : ''}}>14:30</option>
         <option {{($data['start'] ?? '') == '14:45' ? 'selected' : ''}}>14:45</option>
         <option {{($data['start'] ?? '') == '15:00' ? 'selected' : ''}}>15:00</option>
         <option {{($data['start'] ?? '') == '15:15' ? 'selected' : ''}}>15:15</option>
         <option {{($data['start'] ?? '') == '15:30' ? 'selected' : ''}}>15:30</option>
         <option {{($data['start'] ?? '') == '15:45' ? 'selected' : ''}}>15:45</option>
         <option {{($data['start'] ?? '') == '16:00' ? 'selected' : ''}}>16:00</option>
         <option {{($data['start'] ?? '') == '16:15' ? 'selected' : ''}}>16:15</option>
         <option {{($data['start'] ?? '') == '16:30' ? 'selected' : ''}}>16:30</option>
         <option {{($data['start'] ?? '') == '16:45' ? 'selected' : ''}}>16:45</option>
         <option {{($data['start'] ?? '') == '17:00' ? 'selected' : ''}}>17:00</option>
         <option {{($data['start'] ?? '') == '17:15' ? 'selected' : ''}}>17:15</option>
         <option {{($data['start'] ?? '') == '17:30' ? 'selected' : ''}}>17:30</option>
         <option {{($data['start'] ?? '') == '17:45' ? 'selected' : ''}}>17:45</option>
    </select>
    <span class="input-group-text">تا</span>
    <select class="form-select" type="text" id="{{$day}}_{{$time}}_start" name="{{$day}}[{{$time}}][end]">
         <option selected="selected"></option>
         <option {{($data['end'] ?? '') == '12:15' ? 'selected' : ''}}>12:15</option>
         <option {{($data['end'] ?? '') == '12:30' ? 'selected' : ''}}>12:30</option>
         <option {{($data['end'] ?? '') == '12:45' ? 'selected' : ''}}>12:45</option>
         <option {{($data['end'] ?? '') == '13:00' ? 'selected' : ''}}>13:00</option>
         <option {{($data['end'] ?? '') == '13:15' ? 'selected' : ''}}>13:15</option>
         <option {{($data['end'] ?? '') == '13:30' ? 'selected' : ''}}>13:30</option>
         <option {{($data['end'] ?? '') == '13:45' ? 'selected' : ''}}>13:45</option>
         <option {{($data['end'] ?? '') == '14:00' ? 'selected' : ''}}>14:00</option>
         <option {{($data['end'] ?? '') == '14:15' ? 'selected' : ''}}>14:15</option>
         <option {{($data['end'] ?? '') == '14:30' ? 'selected' : ''}}>14:30</option>
         <option {{($data['end'] ?? '') == '14:45' ? 'selected' : ''}}>14:45</option>
         <option {{($data['end'] ?? '') == '15:00' ? 'selected' : ''}}>15:00</option>
         <option {{($data['end'] ?? '') == '15:15' ? 'selected' : ''}}>15:15</option>
         <option {{($data['end'] ?? '') == '15:30' ? 'selected' : ''}}>15:30</option>
         <option {{($data['end'] ?? '') == '15:45' ? 'selected' : ''}}>15:45</option>
         <option {{($data['end'] ?? '') == '16:00' ? 'selected' : ''}}>16:00</option>
         <option {{($data['end'] ?? '') == '16:15' ? 'selected' : ''}}>16:15</option>
         <option {{($data['end'] ?? '') == '16:30' ? 'selected' : ''}}>16:30</option>
         <option {{($data['end'] ?? '') == '16:45' ? 'selected' : ''}}>16:45</option>
         <option {{($data['end'] ?? '') == '17:00' ? 'selected' : ''}}>17:00</option>
         <option {{($data['end'] ?? '') == '17:15' ? 'selected' : ''}}>17:15</option>
         <option {{($data['end'] ?? '') == '17:30' ? 'selected' : ''}}>17:30</option>
         <option {{($data['end'] ?? '') == '17:45' ? 'selected' : ''}}>17:45</option>
         <option {{($data['end'] ?? '') == '18:00' ? 'selected' : ''}}>18:00</option>
    </select>
</div>
