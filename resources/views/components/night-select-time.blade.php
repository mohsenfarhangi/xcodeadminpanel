@props(['day','time'=>'night','data' => []])
<div class="input-group">
    <span class="input-group-text">از</span>
    <select class="form-select" type="text" id="{{$day}}_{{$time}}_start" name="{{$day}}[{{$time}}][start]">
             <option {{($data['start'] ?? '') == '' ? 'selected' : ''}} selected="selected"></option>
             <option {{($data['start'] ?? '') == '00:00' ? 'selected' : ''}}>00:00 </option>
             <option {{($data['start'] ?? '') == '00:15' ? 'selected' : ''}}>00:15 </option>
             <option {{($data['start'] ?? '') == '00:30' ? 'selected' : ''}}>00:30 </option>
             <option {{($data['start'] ?? '') == '00:45' ? 'selected' : ''}}>00:45 </option>
             <option {{($data['start'] ?? '') == '01:00' ? 'selected' : ''}}>01:00 </option>
             <option {{($data['start'] ?? '') == '01:15' ? 'selected' : ''}}>01:15 </option>
             <option {{($data['start'] ?? '') == '01:30' ? 'selected' : ''}}>01:30 </option>
             <option {{($data['start'] ?? '') == '01:45' ? 'selected' : ''}}>01:45 </option>
             <option {{($data['start'] ?? '') == '02:00' ? 'selected' : ''}}>02:00 </option>
             <option {{($data['start'] ?? '') == '02:15' ? 'selected' : ''}}>02:15 </option>
             <option {{($data['start'] ?? '') == '02:30' ? 'selected' : ''}}>02:30 </option>
             <option {{($data['start'] ?? '') == '02:45' ? 'selected' : ''}}>02:45 </option>
             <option {{($data['start'] ?? '') == '03:00' ? 'selected' : ''}}>03:00 </option>
             <option {{($data['start'] ?? '') == '03:15' ? 'selected' : ''}}>03:15 </option>
             <option {{($data['start'] ?? '') == '03:30' ? 'selected' : ''}}>03:30 </option>
             <option {{($data['start'] ?? '') == '03:45' ? 'selected' : ''}}>03:45 </option>
             <option {{($data['start'] ?? '') == '04:00' ? 'selected' : ''}}>04:00 </option>
             <option {{($data['start'] ?? '') == '04:15' ? 'selected' : ''}}>04:15 </option>
             <option {{($data['start'] ?? '') == '04:30' ? 'selected' : ''}}>04:30 </option>
             <option {{($data['start'] ?? '') == '04:45' ? 'selected' : ''}}>04:45 </option>
             <option {{($data['start'] ?? '') == '05:00' ? 'selected' : ''}}>05:00 </option>
             <option {{($data['start'] ?? '') == '05:15' ? 'selected' : ''}}>05:15 </option>
             <option {{($data['start'] ?? '') == '05:30' ? 'selected' : ''}}>05:30 </option>
             <option {{($data['start'] ?? '') == '05:45' ? 'selected' : ''}}>05:45 </option>
             <option {{($data['start'] ?? '') == '06:00' ? 'selected' : ''}}>06:00 </option>
             <option {{($data['start'] ?? '') == '06:15' ? 'selected' : ''}}>06:15 </option>
             <option {{($data['start'] ?? '') == '06:30' ? 'selected' : ''}}>06:30 </option>
             <option {{($data['start'] ?? '') == '06:45' ? 'selected' : ''}}>06:45 </option>
    </select>
    <span class="input-group-text">تا</span>
    <select class="form-select" type="text" id="{{$day}}_{{$time}}_start" name="{{$day}}[{{$time}}][end]">
             <option {{($data['end'] ?? '') == '' ? 'selected' : ''}} selected="selected"></option>
             <option {{($data['end'] ?? '') == '00:15' ? 'selected' : ''}}>00:15 </option>
             <option {{($data['end'] ?? '') == '00:30' ? 'selected' : ''}}>00:30 </option>
             <option {{($data['end'] ?? '') == '00:45' ? 'selected' : ''}}>00:45 </option>
             <option {{($data['end'] ?? '') == '01:00' ? 'selected' : ''}}>01:00 </option>
             <option {{($data['end'] ?? '') == '01:15' ? 'selected' : ''}}>01:15 </option>
             <option {{($data['end'] ?? '') == '01:30' ? 'selected' : ''}}>01:30 </option>
             <option {{($data['end'] ?? '') == '01:45' ? 'selected' : ''}}>01:45 </option>
             <option {{($data['end'] ?? '') == '02:00' ? 'selected' : ''}}>02:00 </option>
             <option {{($data['end'] ?? '') == '02:15' ? 'selected' : ''}}>02:15 </option>
             <option {{($data['end'] ?? '') == '02:30' ? 'selected' : ''}}>02:30 </option>
             <option {{($data['end'] ?? '') == '02:45' ? 'selected' : ''}}>02:45 </option>
             <option {{($data['end'] ?? '') == '03:00' ? 'selected' : ''}}>03:00 </option>
             <option {{($data['end'] ?? '') == '03:15' ? 'selected' : ''}}>03:15 </option>
             <option {{($data['end'] ?? '') == '03:30' ? 'selected' : ''}}>03:30 </option>
             <option {{($data['end'] ?? '') == '03:45' ? 'selected' : ''}}>03:45 </option>
             <option {{($data['end'] ?? '') == '04:00' ? 'selected' : ''}}>04:00 </option>
             <option {{($data['end'] ?? '') == '04:15' ? 'selected' : ''}}>04:15 </option>
             <option {{($data['end'] ?? '') == '04:30' ? 'selected' : ''}}>04:30 </option>
             <option {{($data['end'] ?? '') == '04:45' ? 'selected' : ''}}>04:45 </option>
             <option {{($data['end'] ?? '') == '05:00' ? 'selected' : ''}}>05:00 </option>
             <option {{($data['end'] ?? '') == '05:15' ? 'selected' : ''}}>05:15 </option>
             <option {{($data['end'] ?? '') == '05:30' ? 'selected' : ''}}>05:30 </option>
             <option {{($data['end'] ?? '') == '05:45' ? 'selected' : ''}}>05:45 </option>
             <option {{($data['end'] ?? '') == '06:00' ? 'selected' : ''}}>06:00 </option>
             <option {{($data['end'] ?? '') == '06:15' ? 'selected' : ''}}>06:15 </option>
             <option {{($data['end'] ?? '') == '06:30' ? 'selected' : ''}}>06:30 </option>
             <option {{($data['end'] ?? '') == '06:45' ? 'selected' : ''}}>06:45 </option>
             <option {{($data['end'] ?? '') == '07:00' ? 'selected' : ''}}>07:00 </option>
    </select>
</div>
