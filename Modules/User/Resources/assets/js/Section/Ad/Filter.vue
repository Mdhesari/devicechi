<template>
    <section class="filter-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="filter-price">
                        <!-- <div class="range" id="slider-snap-value-lower">
                            <span class="number"></span>
                            میلیون تومان
                        </div>
                        <div class="range" id="slider-snap-value-higher">
                            <span class="number"></span>
                            میلیون تومان
                        </div>
                        <div
                            id="slider"
                            class="noUi-target noUi-ltr noUi-horizontal"
                        ></div> -->
                        <b-form-input
                            id="range-1"
                            v-model="form.value"
                            type="range"
                            min="0"
                            max="5"
                        ></b-form-input>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="filter-model">
                        <b-form-select
                            id="phone-city"
                            v-model="form.city"
                            :options="cities"
                        ></b-form-select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="filter-city">
                        <b-form-select
                            id="phone-city"
                            v-model="form.city"
                            :options="cities"
                        ></b-form-select>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
export default {
    data() {
        return {
            form: this.$inertia.form({
                city: null,
                value: 1
            }),
            cities: [
                {
                    value: null,
                    text: "nothing"
                }
            ]
        };
    }
};
</script>
