<template>
    <div class="create">
        <ApolloMutation :mutation="require('@/graphql/mutations/createUser.gql')"
                        :variables="{ name: name, email: email, password: password }"
        @done="onDone">
            <template v-slot="{ mutate, loading, error }">
                <form class="col-4">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" v-model="name" >
                    </div>
                    <div class="form-group">
                        <label >Email</label>
                        <input type="email" class="form-control" v-model="email" >
                    </div>
                    <div class="form-group">
                        <label >Password</label>
                        <input type="password" class="form-control" v-model="password" >
                    </div>
                    <button type="submit" :disabled="loading" @click="mutate()" class="btn btn-primary">Create</button>
                </form>
                <p v-if="error">An error occurred: {{ error }}</p>
            </template>
        </ApolloMutation>
    </div>
</template>

<script>
    export default {
        name: 'Create',
        data(){
            return{
                name: '',
                email: '',
                password: '',
            }
        },
        methods: {
            onDone(){
                this.$router.push('/')
            }
        }
    }
</script>
