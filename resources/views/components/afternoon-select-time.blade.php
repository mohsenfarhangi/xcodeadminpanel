@props(['day','time'=>'afternoon','data' => []])
<div class="input-group">
    <span class="input-group-text">از</span>
    <select class="form-select" type="text" id="saturday_morning_start" name="{{$day}}[{{$time}}][start]">
             <option selected="selected"></option>
             <option {{($data['start'] ?? '') == '18:00' ? 'selected' : ''}}>18:00 </option>
             <option {{($data['start'] ?? '') == '18:15' ? 'selected' : ''}}>18:15 </option>
             <option {{($data['start'] ?? '') == '18:30' ? 'selected' : ''}}>18:30 </option>
             <option {{($data['start'] ?? '') == '18:45' ? 'selected' : ''}}>18:45 </option>
             <option {{($data['start'] ?? '') == '19:00' ? 'selected' : ''}}>19:00 </option>
             <option {{($data['start'] ?? '') == '19:15' ? 'selected' : ''}}>19:15 </option>
             <option {{($data['start'] ?? '') == '19:30' ? 'selected' : ''}}>19:30 </option>
             <option {{($data['start'] ?? '') == '19:45' ? 'selected' : ''}}>19:45 </option>
             <option {{($data['start'] ?? '') == '20:00' ? 'selected' : ''}}>20:00 </option>
             <option {{($data['start'] ?? '') == '20:15' ? 'selected' : ''}}>20:15 </option>
             <option {{($data['start'] ?? '') == '20:30' ? 'selected' : ''}}>20:30 </option>
             <option {{($data['start'] ?? '') == '20:45' ? 'selected' : ''}}>20:45 </option>
             <option {{($data['start'] ?? '') == '21:00' ? 'selected' : ''}}>21:00 </option>
             <option {{($data['start'] ?? '') == '21:15' ? 'selected' : ''}}>21:15 </option>
             <option {{($data['start'] ?? '') == '21:30' ? 'selected' : ''}}>21:30 </option>
             <option {{($data['start'] ?? '') == '21:45' ? 'selected' : ''}}>21:45 </option>
             <option {{($data['start'] ?? '') == '22:00' ? 'selected' : ''}}>22:00 </option>
             <option {{($data['start'] ?? '') == '22:15' ? 'selected' : ''}}>22:15 </option>
             <option {{($data['start'] ?? '') == '22:30' ? 'selected' : ''}}>22:30 </option>
             <option {{($data['start'] ?? '') == '22:45' ? 'selected' : ''}}>22:45 </option>
             <option {{($data['start'] ?? '') == '23:00' ? 'selected' : ''}}>23:00 </option>
             <option {{($data['start'] ?? '') == '23:15' ? 'selected' : ''}}>23:15 </option>
             <option {{($data['start'] ?? '') == '23:30' ? 'selected' : ''}}>23:30 </option>
             <option {{($data['start'] ?? '') == '23:45' ? 'selected' : ''}}>23:45 </option>
    </select>
    <span class="input-group-text">تا</span>
    <select class="form-select" type="text" id="saturday_morning_start" name="{{$day}}[{{$time}}][end]">
             <option selected="selected"></option>
             <option {{($data['end'] ?? '') == '18:15' ? 'selected' : ''}}>18:15 </option>
             <option {{($data['end'] ?? '') == '18:30' ? 'selected' : ''}}>18:30 </option>
             <option {{($data['end'] ?? '') == '18:45' ? 'selected' : ''}}>18:45 </option>
             <option {{($data['end'] ?? '') == '19:00' ? 'selected' : ''}}>19:00 </option>
             <option {{($data['end'] ?? '') == '19:15' ? 'selected' : ''}}>19:15 </option>
             <option {{($data['end'] ?? '') == '19:30' ? 'selected' : ''}}>19:30 </option>
             <option {{($data['end'] ?? '') == '19:45' ? 'selected' : ''}}>19:45 </option>
             <option {{($data['end'] ?? '') == '20:00' ? 'selected' : ''}}>20:00 </option>
             <option {{($data['end'] ?? '') == '20:15' ? 'selected' : ''}}>20:15 </option>
             <option {{($data['end'] ?? '') == '20:30' ? 'selected' : ''}}>20:30 </option>
             <option {{($data['end'] ?? '') == '20:45' ? 'selected' : ''}}>20:45 </option>
             <option {{($data['end'] ?? '') == '21:00' ? 'selected' : ''}}>21:00 </option>
             <option {{($data['end'] ?? '') == '21:15' ? 'selected' : ''}}>21:15 </option>
             <option {{($data['end'] ?? '') == '21:30' ? 'selected' : ''}}>21:30 </option>
             <option {{($data['end'] ?? '') == '21:45' ? 'selected' : ''}}>21:45 </option>
             <option {{($data['end'] ?? '') == '22:00' ? 'selected' : ''}}>22:00 </option>
             <option {{($data['end'] ?? '') == '22:15' ? 'selected' : ''}}>22:15 </option>
             <option {{($data['end'] ?? '') == '22:30' ? 'selected' : ''}}>22:30 </option>
             <option {{($data['end'] ?? '') == '22:45' ? 'selected' : ''}}>22:45 </option>
             <option {{($data['end'] ?? '') == '23:00' ? 'selected' : ''}}>23:00 </option>
             <option {{($data['end'] ?? '') == '23:15' ? 'selected' : ''}}>23:15 </option>
             <option {{($data['end'] ?? '') == '23:30' ? 'selected' : ''}}>23:30 </option>
             <option {{($data['end'] ?? '') == '23:45' ? 'selected' : ''}}>23:45 </option>
             <option {{($data['end'] ?? '') == '23:59' ? 'selected' : ''}}>23:59 </option>
    </select>
</div>
