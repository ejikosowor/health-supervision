<template>
    <div class="card text-center">
        <div class="header">
            <h4 class="title">Start Supervision</h4>
        </div>
        <div class="content">
            <div class="form-group">
                <select v-model="selected" class="form-control">
                    <option selected="selected" value="">Select Category</option>
                    <option v-for="category in allCategories" 
                        :key="category.id"
                        :value="category.id"
                        id="select_category">{{ category.name }}</option>
                </select>
            </div>
            <div class="form-group">
                <a :href="catUrl" class="btn btn-primary btn-sm" v-show="selected != ''">Start</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['categories'],
        data() {
            return {
                selected: '',
                allCategories: [],
            }
        },
        created() {
            this.allCategories = this.categories;
        },
        computed: {
            catUrl(){
                return 'online-supervisions/' + this.selected + '/create';
            }
        }
    }
</script>