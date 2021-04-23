<template>
    <form @submit.prevent="submit">
        <span class="gabs__input_group input-group">
            <input name="q" 
                maxlength="200" 
                v-model="keyword"
                :placeholder="trans('strings.search')" 
                autocomplete="off" 
                id="header-search-field" 
                class="main-search form-control">
                
            <span class="input-group-btn">
                <button type="submit" class="btn btn-link">
                    <span class="gicon fa fa-search"></span>
                </button>
            </span>
        </span>
    </form>
</template>

<script>
import { isEmpty } from 'lodash'
const Bloodhound = require('typeahead.js')
const typeahead = require('typeahead.js')
export default {
    name: 'Searchbox',
    data(){
        return {
            keyword: ''
        }
    },

    methods:{
        submit(){
            if( !isEmpty(this.keyword.trim())){
                //this.$router.push(`/search?q=${this.keyword}`)
                location.href=`/search?q=${this.keyword}`
                this.keyword = ''
            }
        }
    },

    mounted(){ 
        // users
        let users = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '/api/autocomplete/users?search=%QUERY%',
                wildcard: '%QUERY%',
                cache:false
            },
        });

        // courses
        let courses = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace('q'),
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            remote: {
                url: '/api/autocomplete/courses?search=%QUERY%',
                wildcard: '%QUERY%',
                cache:false
            },
        });

        $('.main-search').typeahead('destroy');

        $('.main-search').typeahead({
            hint: false,
            highlight: true,
            minLength: 2
        }, {
            name: 'users',
            display: 'name',
            source: users,
            templates: {
                suggestion: (el) => {
                    return '<a href="/user/'+el.username+'" class="user"><h4 class="my-1">'+el.full_name+'</h4></a>'
                }
            }
        }, {
            name: 'courses',
            display: 'title',
            source: courses,
            templates: {
                suggestion: (el) => {
                    return '<a href="/course/'+el.slug+'" class="course"><h4 class="my-1">'+el.title + '</h4></a>'
                }
            }
        })

    }
}
</script>
