<template>
    <div class="uk-flex uk-flex-center">
        <div class="uk-width-2-3 uk-card uk-card-default uk-card-body">
            <form @submit.prevent="updateCar">
                <fieldset class="uk-fieldset">
                    <legend class="uk-legend">Edit Car Details</legend>
                    <div class="uk-margin">
                        <label class="uk-form-label" for="form-stacked-select">Car Make</label>
                        <div class="uk-form-controls">
                            <select required class="uk-select" id="form-stacked-select" v-model="car.make">
                                <option v-for="(opt, index) in makeOptions" :key="index" :value="opt">{{opt}}</option>
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
                    <button type="submit" class="uk-button uk-button-primary">Save</button>
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
        created() {
            this.axios
                .get(`${BASE_URL}/api/cars/${this.$route.params.id}/edit`)
                .then((response) => {
                    this.car = response.data;
                    // console.log(response.data);
                });

            this.options = this.axios
                .get('${BASE_URL}/api/carOptions')
                .then(response => {
                    this.options = response.data;
                });
        },
        methods: {
            updateCar() {
                this.axios
                    .post(`${BASE_URL}/api/cars/${this.$route.params.id}/update`, this.car)
                    .then((response) => {
                        this.$router.push({name: 'home'});
                    });
            }
        }
    }
</script>
