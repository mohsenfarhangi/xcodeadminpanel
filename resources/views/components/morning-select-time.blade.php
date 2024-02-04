@props(['day','time' => 'morning','data' => []])
<div class="input-group">
    <span class="input-group-text">از</span>
    <select class="form-select" type="text" id="{{$day}}_{{$time}}_start" name="{{$day}}[{{$time}}][start]">
        <option selected="selected"></option>
        <option {{($data['start'] ?? '') == '07:00' ? 'selected' : ''}}>07:00 </option>
        <option {{($data['start'] ?? '') == '07:15' ? 'selected' : ''}}>07:15 </option>
         <option {{($data['start'] ?? '') == '07:30' ? 'selected' : ''}}>07:30 </option>
         <option {{($data['start'] ?? '') == '07:45' ? 'selected' : ''}}>07:45 </option>
         <option {{($data['start'] ?? '') == '08:00' ? 'selected' : ''}}>08:00 </option>
         <option {{($data['start'] ?? '') == '08:15' ? 'selected' : ''}}>08:15 </option>
         <option {{($data['start'] ?? '') == '08:30' ? 'selected' : ''}}>08:30 </option>
         <option {{($data['start'] ?? '') == '08:45' ? 'selected' : ''}}>08:45 </option>
         <option {{($data['start'] ?? '') == '09:00' ? 'selected' : ''}}>09:00 </option>
         <option {{($data['start'] ?? '') == '09:15' ? 'selected' : ''}}>09:15 </option>
         <option {{($data['start'] ?? '') == '09:30' ? 'selected' : ''}}>09:30 </option>
         <option {{($data['start'] ?? '') == '09:45' ? 'selected' : ''}}>09:45 </option>
         <option {{($data['start'] ?? '') == '10:00' ? 'selected' : ''}}>10:00 </option>
         <option {{($data['start'] ?? '') == '10:15' ? 'selected' : ''}}>10:15 </option>
         <option {{($data['start'] ?? '') == '10:30' ? 'selected' : ''}}>10:30 </option>
         <option {{($data['start'] ?? '') == '10:45' ? 'selected' : ''}}>10:45 </option>
         <option {{($data['start'] ?? '') == '11:00' ? 'selected' : ''}}>11:00 </option>
         <option {{($data['start'] ?? '') == '11:15' ? 'selected' : ''}}>11:15 </option>
         <option {{($data['start'] ?? '') == '11:30' ? 'selected' : ''}}>11:30 </option>
         <option {{($data['start'] ?? '') == '11:45' ? 'selected' : ''}}>11:45 </option>
         <option {{($data['start'] ?? '') == '12:00' ? 'selected' : ''}}>12:00 </option>
         <option {{($data['start'] ?? '') == '12:15' ? 'selected' : ''}}>12:15 </option>
         <option {{($data['start'] ?? '') == '12:30' ? 'selected' : ''}}>12:30 </option>
         <option {{($data['start'] ?? '') == '12:45' ? 'selected' : ''}}>12:45 </option>
         <option {{($data['start'] ?? '') == '13:00' ? 'selected' : ''}}>13:00 </option>
         <option {{($data['start'] ?? '') == '13:15' ? 'selected' : ''}}>13:15 </option>
         <option {{($data['start'] ?? '') == '13:30' ? 'selected' : ''}}>13:30 </option>
         <option {{($data['start'] ?? '') == '13:45' ? 'selected' : ''}}>13:45 </option>
    </select>
    <span class="input-group-text">تا</span>
    <select class="form-select" type="text" id="{{$day}}_{{$time}}_start" name="{{$day}}[{{$time}}][end]">
         <option selected="selected"></option>
         <option {{($data['end'] ?? '') == '07:15' ? 'selected' : ''}}>07:15 </option>
         <option {{($data['end'] ?? '') == '07:30' ? 'selected' : ''}}>07:30 </option>
         <option {{($data['end'] ?? '') == '07:45' ? 'selected' : ''}}>07:45 </option>
         <option {{($data['end'] ?? '') == '08:00' ? 'selected' : ''}}>08:00 </option>
         <option {{($data['end'] ?? '') == '08:15' ? 'selected' : ''}}>08:15 </option>
         <option {{($data['end'] ?? '') == '08:30' ? 'selected' : ''}}>08:30 </option>
         <option {{($data['end'] ?? '') == '08:45' ? 'selected' : ''}}>08:45 </option>
         <option {{($data['end'] ?? '') == '09:00' ? 'selected' : ''}}>09:00 </option>
         <option {{($data['end'] ?? '') == '09:15' ? 'selected' : ''}}>09:15 </option>
         <option {{($data['end'] ?? '') == '09:30' ? 'selected' : ''}}>09:30 </option>
         <option {{($data['end'] ?? '') == '09:45' ? 'selected' : ''}}>09:45 </option>
         <option {{($data['end'] ?? '') == '10:00' ? 'selected' : ''}}>10:00 </option>
         <option {{($data['end'] ?? '') == '10:15' ? 'selected' : ''}}>10:15 </option>
         <option {{($data['end'] ?? '') == '10:30' ? 'selected' : ''}}>10:30 </option>
         <option {{($data['end'] ?? '') == '10:45' ? 'selected' : ''}}>10:45 </option>
         <option {{($data['end'] ?? '') == '11:00' ? 'selected' : ''}}>11:00 </option>
         <option {{($data['end'] ?? '') == '11:15' ? 'selected' : ''}}>11:15 </option>
         <option {{($data['end'] ?? '') == '11:30' ? 'selected' : ''}}>11:30 </option>
         <option {{($data['end'] ?? '') == '11:45' ? 'selected' : ''}}>11:45 </option>
         <option {{($data['end'] ?? '') == '12:00' ? 'selected' : ''}}>12:00 </option>
         <option {{($data['end'] ?? '') == '12:15' ? 'selected' : ''}}>12:15 </option>
         <option {{($data['end'] ?? '') == '12:30' ? 'selected' : ''}}>12:30 </option>
         <option {{($data['end'] ?? '') == '12:45' ? 'selected' : ''}}>12:45 </option>
         <option {{($data['end'] ?? '') == '13:00' ? 'selected' : ''}}>13:00 </option>
         <option {{($data['end'] ?? '') == '13:15' ? 'selected' : ''}}>13:15 </option>
         <option {{($data['end'] ?? '') == '13:30' ? 'selected' : ''}}>13:30 </option>
         <option {{($data['end'] ?? '') == '13:45' ? 'selected' : ''}}>13:45 </option>
         <option {{($data['end'] ?? '') == '14:00' ? 'selected' : ''}}>14:00 </option>
    </select>
</div>
