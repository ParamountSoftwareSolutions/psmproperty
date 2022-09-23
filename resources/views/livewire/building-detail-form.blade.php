<div xmlns:wire="http://www.w3.org/1999/xhtml">
    <div class="card">
        <form wire:submit.prevent="buildingDetail">
            @if($currentStep == 1)
                {{--  Setep1 --}}
                <div class="step-one">
                    <div class="card-header">
                        <h4>Basic Information</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <div class="form-group">
                                    <label>Building</label>
                                    <select class="form-control" wire:model="building_id" name="building_id">
                                        <option value="">None</option>
                                        @foreach($building as $data)
                                            <option value="{{ $data->id }}" selected>{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('building_id')
                                    <div class="text-danger mt-2">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($currentStep == 2)
                <div class="step-two">
                    <div class="card-header">
                        <h4>2nd Step Information</h4>
                    </div>
                    <?php $floor_id = [] ?>
                    @foreach($floor as $data)
                        <?php $floor_id = $data ?>
                        <div class="card-header">
                            <h4>{{ $data->name }} Information</h4>
                        </div>
                            <input type="hidden" wire:model="building_id" value="{{ $building_id }}">
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label>Shop</label>
                                        <input type="number" class="form-control" name="shop" wire:model="shop.{{ $data['id'] }}"  placeholder="No of shops">
                                        @error('shop')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label>Studio</label>
                                        <input type="number" class="form-control" name="studio"
                                               wire:model="studio.{{ $data['id'] }}" placeholder="No of studio">
                                        @error('studio')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label>Flats</label>
                                        <input type="number" class="form-control" name="flat"
                                               wire:model="flat.{{ $data['id'] }}" placeholder="No of flats">
                                        @error('flat')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label>Apartment</label>
                                        <input type="number" class="form-control" name="apartment" wire:model="apartment.{{ $data['id'] }}"
                                               placeholder="No of apartment">
                                        @error('apartment')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label>Pent House</label>
                                        <input type="number" class="form-control" name="flat"
                                               wire:model="flat.{{ $data['id'] }}" placeholder="No of flats">
                                        @error('flat')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label>Office</label>
                                        <input type="number" class="form-control" name="office"
                                               wire:model="office.{{ $data['id'] }}" placeholder="No of offices">
                                        @error('office')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label>Pent House</label>
                                        <input type="number" class="form-control" name="pent_house"
                                               wire:model="pent_house.{{ $data['id'] }}" placeholder="No of Pent Houses">
                                        @error('pent_house')
                                        <div class="text-danger mt-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif


            <div class="card-footer text-right">
                @if($currentStep == 2)
                    <button class="btn btn-primary mr-2" type="button" wire:click="decreaseStep">Back</button>
                @endif
                @if($currentStep == 1)
                    <button class="btn btn-primary mr-2" type="button" wire:click="increaseStep">Next</button>
                @endif
                @if($currentStep == 2)
                    <button class="btn btn-primary mr-2" type="submit">Submit</button>
                @endif
            </div>
        </form>
    </div>
</div>
