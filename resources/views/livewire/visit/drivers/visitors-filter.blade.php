<div>
            <div class="row mb-2">
                <label style="color: #070707" for=""><h4>Filter By:</h4></label>
                <div class="col-md-5" style="width: 50%;" >
                    <label style="color: #070707" for=""><h5>Visitor Type</h5></label>
        <select wire:model="selectedVisitorTypeId" wire:change="updatedSelectedVisitorTypeId">
            <option value="0">All</option>
            @foreach ($visitorTypes as $visitorType)
                <option value="{{ $visitorType->id }}">{{ $visitorType->name }}</option>
            @endforeach
        </select>

    </div>

    <div class="col-md-5">
        <label style="color: #070707" for=""><h5>Verification Type</h5></label>
        <select wire:model="selectedIdentificationTypeId" wire:change="updatedSelectedIdentificationTypeId">
            <option value="0">All</option>
            @foreach ($identificationTypes as $identificationType)
                <option value="{{ $identificationType->id }}">{{ $identificationType->name }}</option>
            @endforeach
        </select>
    </div>

</div>
