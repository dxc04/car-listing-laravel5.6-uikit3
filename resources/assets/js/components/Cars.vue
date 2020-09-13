<template>
    <div class="uk-width-1-1">
        <div class="uk-position-left uk-float-left uk-width-1-5 uk-margin-remove-top" uk-grid uk-height-match="target: > div > .uk-card">
            <div class="uk-card uk-card-default">
                <div class="uk-card-header"> 
                    <h3 class="uk-card-title">Filters</h3>
                </div>
                <div class="uk-card-body uk-padding-remove-top">
                    <div class="uk-margin" style="margin-top: 20px;">
                        <div class="uk-form-label uk-text-bolder">Car Make
                            <span class="uk-float-right uk-text-warning" style="cursor: pointer;" @click="filters.make = []">Clear</span>
                        </div>
                        <div class="uk-form-controls uk-flex uk-flex-column car-filter">
                            <label class="uk-margin-right uk-margin-top  uk-text-uppercase tag-label" v-for="(opt, index) in makeOptions" :key="index">
                                <input :id="opt" v-model="filters.make" class="uk-checkbox" type="checkbox" :value="opt"> {{opt}}
                            </label>
                        </div>         
                    </div>
                    <div class="uk-margin">
                        <div class="uk-form-label uk-text-bolder">Model
                            <span class="uk-float-right uk-text-warning" style="cursor: pointer;" @click="filters.model = []">Clear</span>
                        </div>
                        <div class="uk-form-controls uk-flex uk-flex-column car-filter">
                            <label class="uk-margin-right uk-margin-top  uk-text-uppercase tag-label" v-for="(opt, index) in modelOptions" :key="index">
                                <input :id="opt" v-model="filters.model" class="uk-checkbox" type="checkbox" :value="opt"> {{opt}}
                            </label>
                        </div>         
                    </div>
                    <div class="uk-margin">
                        <div class="uk-form-label uk-text-bolder">Year
                            <span class="uk-float-right uk-text-warning" style="cursor: pointer;" @click="filters.year = []">Clear</span>
                        </div>
                        <div class="uk-form-controls uk-flex uk-flex-column car-filter">
                            <label class="uk-margin-right uk-margin-top  uk-text-uppercase tag-label" v-for="(opt, index) in yearOptions" :key="index">
                                <input :id="opt" v-model="filters.year" class="uk-checkbox" type="checkbox" :value="opt"> {{opt}}
                            </label>
                        </div>         
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label uk-text-bolder">Price Range 
                            <span v-if="filters.price" class="uk-badge tag-label">Up to {{formattedPrice(filters.price)}}</span>
                        </label>
                        <div class="uk-flex uk-flex-1 uk-width-1-1">
                            <span>0</span>
                                <div class="uk-width-1-1" style="padding: 0 5px;"><input v-model="filters.price" class="uk-range" type="range" value="2" min="0" max="3000000" step="100000"></div>
                            <span>3M</span>
                        </div>
                    </div>
                </div>
                <div class="uk-card-footer uk-margin-top-medium">
                    <div class="uk-margin">
                        <div class="uk-form-label uk-text-bolder">
                            Body Type<span class="uk-float-right uk-text-warning" style="cursor: pointer;" @click="filters.body_type = []">Clear</span>
                        </div>
                        <div class="uk-form-controls uk-flex uk-flex-column car-filter">
                            <label class="uk-margin-right uk-margin-top  uk-text-uppercase tag-label" v-for="(opt, index) in bodyTypeOptions" :key="index">
                                <input :id="opt" v-model="filters.body_type" class="uk-checkbox" type="checkbox" :value="opt"> {{opt}}
                            </label>
                        </div>         
                    </div>
                    <div class="uk-margin">
                        <div class="uk-form-label uk-text-bolder">
                            Fuel Type <span class="uk-float-right uk-text-warning" style="cursor: pointer;" @click="filters.fuel_type = []">Clear</span>
                        </div>
                        <div class="uk-form-controls uk-flex uk-flex-column car-filter">
                            <label class="uk-margin-right uk-margin-top  uk-text-uppercase tag-label" v-for="(opt, index) in fuelTypeOptions" :key="index">
                                <input :id="opt" v-model="filters.fuel_type" class="uk-checkbox" type="checkbox" :value="opt"> {{opt}}
                            </label>
                        </div>         
                    </div>
                    <div class="uk-margin">
                        <div class="uk-form-label uk-text-bolder">Transmission
                            <span class="uk-float-right uk-text-warning" style="cursor: pointer;" @click="filters.transmission = []">Clear</span>
                        </div>
                        <div class="uk-form-controls uk-flex uk-flex-column car-filter">
                            <label class="uk-margin-right uk-margin-top  uk-text-uppercase tag-label" v-for="(opt, index) in transmissionOptions" :key="index">
                                <input :id="opt" v-model="filters.transmission" class="uk-checkbox" type="checkbox" :value="opt"> {{opt}}
                            </label>
                        </div>         
                    </div>                
                </div>
            </div>
            
        </div>
        <div class="uk-margin-remove-top" style="margin-left: 140px; width: 1500px;">
            <div class="uk-flex uk-flex-wrap uk-flex-wrap-around" uk-height-match="target: .uk-card > .uk-card-body > p" >
                <div v-for="car in filteredCars" :key="car.id" class="uk-width-1-5 uk-text-small uk-card uk-card-default car-card">
                    <div class="uk-card-header uk-padding-small">
                        <span class="uk-text-title uk-text-large">{{car.make}} {{car.model}}</span>
                        <ul class="uk-text-meta uk-subnav uk-subnav-divider uk-margin-remove-top">
                            <li>{{car.year}}</li>
                            <li class="uk-text-success">{{formattedPrice(car.price)}}</li>
                        </ul>
                    </div>
                    <div class="uk-card-body uk-padding-small">
                        <span class="tag-label uk-label uk-text-light">{{car.body_type}}</span>
                        <span class="tag-label uk-label uk-text-light">{{car.fuel_type}}</span>
                        <span class="tag-label uk-label uk-text-light">{{car.transmission}}</span>
                        <p>{{car.description}}</p>
                    </div>
                    <div class="uk-card-footer uk-margin-remove-right uk-padding-small">
                        <div class="uk-float-right uk-margin-remove-right">
                            <router-link :to="{name: 'edit', params: { id: car.id }}" class="uk-icon-button" uk-icon="icon: file-edit">
                            </router-link>
                            <a @click="deleteCar(car.id)" class="uk-icon-button uk-form-danger" uk-icon="icon: trash"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                cars: [],
                filters: {
                    make: [],
                    model: [],
                    year: [],
                    price: null,
                    body_type: [],
                    fuel_type: [],
                    transmission: []
                },
                options: {
                    make: [],
                    body_types: [],
                    fuel_types: [],
                    transmissions: []
                }
            }
        },
        computed: {
            makeOptions() {
                return this.options.make;
            },
            modelOptions() {
                return this.getOptionsBy('model', 'make');
            },
            yearOptions() {
                return this.getOptionsBy('year');
            },
            bodyTypeOptions() {
                return this.options.body_types;
            },
            fuelTypeOptions() {
                return this.options.fuel_types;
            },
            transmissionOptions() {
                return this.options.transmissions;
            },
            filteredCars() {
                return this.hasFilters
                    ? this.cars.filter(car => {
                        const { make, model, year, price, body_type, fuel_type, transmission } = this.filters;
                        return (!make.length || (make.length && make.includes(car.make)))
                            && (!model.length || (model.length && model.includes(car.model)))
                            && (!year.length || (year.length && year.includes(car.year)))
                            && (!price || (price && car.price <= price))
                            && (!body_type.length || (body_type.length && body_type.includes(car.body_type)))
                            && (!fuel_type.length || (fuel_type.length && fuel_type.includes(car.fuel_type)))
                            && (!transmission.length || (transmission.length && transmission.includes(car.transmission)));
                    })
                    : this.cars
            },
            hasFilters() {
                const { make, model, year, price, body_type, fuel_type, transmission } = this.filters;
                return make.length || model.length || year.length || price
                    || body_type.length || fuel_type.length || transmission.length;
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/cars')
                .then(response => {
                    this.cars = response.data;
                });
            this.options = this.axios
                .get('http://localhost:8000/api/carOptions')
                .then(response => {
                    this.options = response.data;
                });
        },
        methods: {
            formattedPrice(price) {
                return new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP' }).format(price)
            },
            deleteCar(id) {
                this.axios
                    .delete(`http://localhost:8000/api/car/delete/${id}`)
                    .then(response => {
                        let i = this.cars.map(item => item.id).indexOf(id);
                        this.cars.splice(i, 1)
                    });
            },
            getOptionsBy(option, filter = null) {
                if (filter && this.filters[filter].length) {
                    const options = this.filteredCars.reduce((options, car, index) => {
                        if (this.filters[filter].find(make => make == car[filter])) {
                            options.push(car[option]);
                        }
                        return options;
                    }, [])
                    return [...new Set(options)];
                }

                return [...new Set(this.cars.reduce((options, car, index) => {
                    options.push(car[option]);
                    return options;
                }, []))];
            },
            showAllOptions(filter)  {
                const addedFilters = Object.values(this.filters).reduce(f => {
                    return  Array.isArray(f) ? f.length : f
                })
                return (!addedFilters.length && this.filters[filter].length) || !this.hasFilters;
            }
        }
    }
</script>

<style>
    .tag-label {
        font-size: 10px !important;
    }
    .car-filter {
        height: 100px;
        overflow-y: scroll;
        padding: 2px 3px;
    }
    .car-card {
        margin-right: 16px;
        margin-bottom: 16px;
    }
</style>