@if(isset($branchOffices) && !empty($branchOffices))
    @foreach($branchOffices as $branchOffice)
        <label>
            <input type="radio" name="branchOffice" value="{{ htmlspecialchars($branchOffice['uuid']) }}"
                {{ ($existingBranchOffice === $branchOffice['uuid']) ? 'checked' : '' }}>
            {{ htmlspecialchars($branchOffice['name']) }}
        </label> <br>
    @endforeach
@else
    <div>No branch offices have been entered yet!</div>
@endif
<br>
