@if(isset($branchOffices) && !empty($branchOffices))
    @foreach($branchOffices as $branchOffice)
        <label>
            <input type="radio" name="branch_office" value="{{ $branchOffice->uuid }}"
                {{ ($existingBranchOfficeUuid === $branchOffice->uuid) ? 'checked' : '' }}>
            {{ $branchOffice->name }}
        </label> <br>
    @endforeach
@else
    <div>No branch offices have been entered yet!</div>
@endif
<br>
