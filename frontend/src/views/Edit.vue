<template>

    <div class="edit">
        <ApolloQuery :query="require('@/graphql/queries/user.gql')" :variables="{ id: id }">
            <template slot-scope="{ result: { data, loading },isLoading }">
                <div v-if="isLoading">Loading...</div>
                <ApolloMutation :mutation="require('@/graphql/mutations/updateUser.gql')"
                                :variables="{id: id, name: name, email: email, }"
                                @done="onDone">
                    <template v-slot="{ mutate, loading, error }">
                        <form class="col-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" id="name" class="form-control" v-model="data.user[0].name" >
                            </div>
                            <div class="form-group">
                                <label >Email</label>
                                <input type="email" id="email" class="form-control" v-model="data.user[0].email" >
                            </div>
                            <button type="submit" :disabled="loading" @click="mutate()" class="btn btn-primary">Update</button>
                        </form>
                        <p v-if="error">An error occurred: {{ error }}</p>
                    </template>
                </ApolloMutation>
            </template>
        </ApolloQuery>
    </div>
</template>

<script>

    export default {
        name: 'Edit',
        props : ['id'],
        data(){
            return{
                user: [],
                name: '',
                email: '',
            }
        },

        methods: {
            onDone(){
                this.$router.push('/')
            }
        },
    }
</script>


