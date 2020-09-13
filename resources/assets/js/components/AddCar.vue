<template>
    <div class="uk-flex uk-flex-center">
        <div class="uk-width-2-3 uk-card uk-card-default uk-card-body">
            <form @submit.prevent="addCar">
                <fieldset class="uk-fieldset">
                    <legend class="uk-legend">Add Car to Listing</legend>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-stacked-select">Car Make</label>
                        <div class="uk-form-controls">
                            <select required class="uk-select" id="form-stacked-select" v-model="car.make">
                                <option v-for="(opt, index) in makeOptions" :key="index">{{opt}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label ">Model</label>
                        <div class="uk-margin-remove-top uk-margin-small">
                            <input required type="text" class="uk-input " v-model="car.model">
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label">Year</label>
                        <div class="uk-margin-remove-top uk-margin-small">
                            <input required type="text" class="uk-input" v-model="car.year">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label ">Price</label>
                        <div class="uk-margin-remove-top uk-margin-small">
                            <input required type="text" class="uk-input" v-model="car.price">
                        </div>
                    </div>

                    <div class="uk-margin">
                        <label class="uk-form-label ">Description</label>
                        <textarea required class="uk-textarea" rows="2" v-model="car.description"></textarea>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-stacked-select">Body Type</label>
                        <div class="uk-form-controls">
                            <select required class="uk-select" id="form-stacked-select" v-model="car.body_type">
                                <option v-for="(opt, index) in bodyTypeOptions" :key="index">{{opt}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-stacked-select">Fuel Type</label>
                        <div class="uk-form-controls">
                            <select required class="uk-select" id="form-stacked-select" v-model="car.fuel_type">
                                <option v-for="(opt, index) in fuelTypeOptions" :key="index">{{opt}}</option>
                            </select>
                        </div>
                    </div>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-stacked-select">Transmission</label>
                        <div class="uk-form-controls">
                            <select required class="uk-select" id="form-stacked-select" v-model="car.transmission">
                                <option v-for="(opt, index) in transmissionOptions" :key="index">{{opt}}</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="uk-button uk-button-primary">Add Car</button>
                </fieldset>
            </form>
        </div>
    </div>
</template>

<script>

    export default {
        data() {
            return {
                car: {},
                options: {
                    make: [],
                    body_types: [],
                    fuel_types: [],
                    transmissions: []
                }
            }
        },
        created() {
            this.options = this.axios
                .get('http://localhost:8000/api/carOptions')
                .then(response => {
                    this.options = response.data;
                });
        },
        computed: {
            makeOptions() {
                return this.options.make;
            },
            bodyTypeOptions() {
                return this.options.body_types;
            },
            fuelTypeOptions() {
                return this.options.fuel_types;
            },
            transmissionOptions() {
                return this.options.transmissions;
            }            
        },
        methods: {
            addCar() {
                this.axios
                    .post('http://localhost:8000/api/car/add', this.car)
                    .then(response => (
                        this.$router.push({name: 'home'})
                        // console.log(response.data)
                    ))
                    .catch(error => console.log(error))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>