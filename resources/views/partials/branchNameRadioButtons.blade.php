@if(isset($branchOffices) && !empty($branchOffices))
    @foreach($branchOffices as $branchOffice)
        <label>
            <input type="radio" name="branch_office" value="{{ $branchOffice->id }}"
                {{ ($existingBranchOfficeUuid === $branchOffice->id) ? 'checked' : '' }}>
            {{ $branchOffice->name }}
        </label> <br>
    @endforeach
@else
    <div>No branch offices have been entered yet!</div>
@endif
<br>
