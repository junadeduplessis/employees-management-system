<template>
    <div>
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Employees</h1>
        </div>

        <div class="card">
            <div v-if="showMessage">
                <div class="alert alert-success">{{ message }}</div>
            </div>
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <form>
                            <div class="form-row align-items-cneter">
                                <div class="col">
                                    <input
                                        type="search"
                                        v-model.lazy="search"
                                        class="form-control mb-2"
                                        placeholder="Type to search..."
                                        @change="getEmployees()"
                                    />
                                </div>
                                <div class="col">
                                    <button
                                        type="submit"
                                        class="btn btn-primary mb-2"
                                    >
                                        Search
                                    </button>
                                </div>
                                <div class="col">
                                    <select
                                        v-model="selectedDepartment"
                                        id="department"
                                        type="search"
                                        class="form-control"
                                        required
                                        @change="getEmployees()"
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
                        </form>
                    </div>
                    <div>
                        <router-link
                            :to="{ name: 'EmployeesCreate' }"
                            class="btn btn-primary mb-2"
                            >Create</router-link
                        >
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">First Name</th>
                            <th scope="col">Last Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Department</th>
                            <th scope="col">City</th>
                            <th scope="col">State</th>
                            <th scope="col">Country</th>
                            <th scope="col">Date Hired</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="employee in employees" :key="employee.id">
                            <td># {{ employee.id }}</td>
                            <td>{{ employee.first_name }}</td>
                            <td>{{ employee.last_name }}</td>
                            <td>{{ employee.address }}</td>
                            <td>{{ employee.department.name }}</td>
                            <td>{{ employee.city.name }}</td>
                            <td>{{ employee.state.name }}</td>
                            <td>{{ employee.country.name }}</td>
                            <td>{{ employee.date_hired }}</td>
                            <td>
                                <router-link
                                    :to="{
                                        name: 'EmployeesEdit',
                                        params: { id: employee.id }
                                    }"
                                    class="btn btn-secondary"
                                    >Edit</router-link
                                >
                                <button class="btn btn-danger" @click="deleteEmployee(employee.id)">Delete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            employees: [],
            showMessage: false,
            message: '',
            departments: [],
            search: null,
            selectedDepartment: null
        };
    },
    created() {
        this.getEmployees();
        this.getDepartments();
    },
    methods: {
        getEmployees() {
            axios
                .get("/api/employees", { params: {
                    search: this.search,
                    department_id: this.selectedDepartment
                }})
                .then(response => {
                    this.employees = response.data.data;
                })
                .catch(error => {
                    console.log(error);
                });
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
        deleteEmployee(id) {
            axios
                .delete("api/employees/" + id)
                .then(response => {
                    this.showMessage = true;
                    this.message = response.data;
                    this.getEmployees();
                })
                .catch(error => {
                    console.log(error);
                });
        }
    }
};
</script>

<style></style>
