<template>
    <div>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Employees</h1>
        </div>

        <div class="card">
            <div class="card-header">
                Edit Employee
                <router-link
                    :to="{ name: 'EmployeesIndex' }"
                    class="btn btn-primary float-right"
                    >Back</router-link
                >
            </div>
            <div class="card-body">
                <form>
                    <div class="form-group row">
                        <label
                            for="first_name"
                            class="col-md-4 col-form-label text-md-right"
                            >First Name</label
                        >
                        <div class="col-md-6">
                            <input
                                v-model="employee.first_name"
                                id="first_name"
                                type="text"
                                class="form-control"
                                required
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="middle_name"
                            class="col-md-4 col-form-label text-md-right"
                            >Middle Name</label
                        >

                        <div class="col-md-6">
                            <input
                                v-model="employee.middle_name"
                                id="middle_name"
                                type="text"
                                class="form-control"
                                required
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="last_name"
                            class="col-md-4 col-form-label text-md-right"
                            >Last Name</label
                        >

                        <div class="col-md-6">
                            <input
                                v-model="employee.last_name"
                                id="last_name"
                                type="text"
                                class="form-control"
                                required
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="address"
                            class="col-md-4 col-form-label text-md-right"
                            >Address</label
                        >

                        <div class="col-md-6">
                            <input
                                v-model="employee.address"
                                id="address"
                                type="text"
                                class="form-control"
                                required
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="department"
                            class="col-md-4 col-form-label text-md-right"
                            >Department</label
                        >

                        <div class="col-md-6">
                            <select
                                v-model="employee.department_id"
                                id="department"
                                type="text"
                                class="form-control"
                                required
                            >
                                <option>Please select an option</option>
                                <option
                                    v-for="department in departments"
                                    :key="department.id"
                                    :value="department.id"
                                    >{{ department.name }}</option
                                >
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="country"
                            class="col-md-4 col-form-label text-md-right"
                            >Country</label
                        >

                        <div class="col-md-6">
                            <select
                                v-model="employee.country_id"
                                @change="getStates(), employee.state_id = '', employee.city_id = ''"
                                id="country"
                                type="text"
                                class="form-control"
                                required
                            >
                                <option>Please select an option</option>
                                <option
                                    v-for="country in countries"
                                    :key="country.id"
                                    :value="country.id"
                                    >{{ country.name }}</option
                                >
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="state"
                            class="col-md-4 col-form-label text-md-right"
                            >State</label
                        >

                        <div class="col-md-6">
                            <select
                                v-model="employee.state_id"
                                @change="getCities(), employee.city_id = ''"
                                id="state"
                                type="text"
                                class="form-control"
                                required
                            >
                                <option>Please select an option</option>
                                <option
                                    v-for="state in states"
                                    :key="state.id"
                                    :value="state.id"
                                    >{{ state.name }}</option
                                >
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="city"
                            class="col-md-4 col-form-label text-md-right"
                            >City</label
                        >

                        <div class="col-md-6">
                            <select
                                v-model="employee.city_id"
                                id="city"
                                type="text"
                                class="form-control"
                                required
                            >
                                <option>Please select an option</option>
                                <option
                                    v-for="city in cities"
                                    :key="city.id"
                                    :value="city.id"
                                    >{{ city.name }}</option
                                >
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="zip_code"
                            class="col-md-4 col-form-label text-md-right"
                            >Zip Code</label
                        >

                        <div class="col-md-6">
                            <input
                                v-model="employee.zip_code"
                                id="zip_code"
                                type="text"
                                class="form-control"
                                required
                            />
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="birth_date"
                            class="col-md-4 col-form-label text-md-right"
                            >Birth Date</label
                        >
                        <div class="col-md-6">
                            <datepicker input-class="form-control" v-model="employee.birth_date"></datepicker>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label
                            for="date_hired"
                            class="col-md-4 col-form-label text-md-right"
                            >Date Hired</label
                        >
                        <div class="col-md-6">
                            <datepicker input-class="form-control" v-model="employee.date_hired"></datepicker>
                        </div>
                    </div>

                    <div class="form-group row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-primary" @click.prevent="updateEmployee()">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from "vuejs-datepicker";
import moment from "moment";
export default {
    components: {
        Datepicker
    },
    data() {
        return {
            employee: [],
            countries: [],
            states: [],
            departments: [],
            cities: [],
        };
    },
    created() {
        this.getEmployee();
        this.getCountries();
        this.getDepartments();
    },
    methods: {
        customDateFormatter(date) {
            if (date) {
                return moment(String(date)).format("YYYYMMDD");
            }
        },
        getEmployee() {
            const employeeID = this.$route.params.id;

            axios
                .get("/api/employees/edit/" + employeeID)
                .then(response => {
                    this.employee = response.data;
                })
                .catch(error => {
                    console.log(error);
                })
        },
        getDepartments() {
            axios
                .get("/api/employees/departments")
                .then(response => {
                    this.departments = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getCountries() {
            axios
                .get("/api/employees/countries")
                .then(response => {
                    this.countries = response.data;
                    this.getStates();
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getStates() {
            axios
                .get("/api/employees/" + this.employee.country_id + "/states")
                .then(response => {
                    this.states = response.data;
                    this.getCities();
                })
                .catch(error => {
                    console.log(error);
                });
        },
        getCities() {
            axios
                .get("/api/employees/" + this.employee.state_id + "/cities")
                .then(response => {
                    this.cities = response.data;
                })
                .catch(error => {
                    console.log(error);
                });
        },
        updateEmployee() {
            axios
                .post("/api/employees/update/" + this.employee.id, {
                    'first_name': this.employee.first_name,
                    'middle_name': this.employee.middle_name,
                    'last_name': this.employee.last_name,
                    'address': this.employee.address,
                    'department_id': this.employee.department_id,
                    'country_id': this.employee.country_id,
                    'state_id': this.employee.state_id,
                    'city_id': this.employee.city_id,
                    'zip_code': this.employee.zip_code,
                    'birth_date': this.customDateFormatter(this.employee.birth_date),
                    'date_hired': this.customDateFormatter(this.employee.date_hired),
                })
                .then(response => {
                    this.$router.push({ name: 'EmployeesIndex' });
                })
                .catch(error => {
                    console.log(error);
                })
        }
    }
};
</script>

<style></style>
