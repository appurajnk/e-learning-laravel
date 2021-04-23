
<script>
import Mmenu from 'mmenu-js'
export default {
    props:['categories', 'user'],
    data(){
        return {
            showSearch: false
        }    
    },
    
    mounted(){
        new Mmenu("#mobileMenu", {
            // "wrappers": ["bootstrap"],
            "extensions": [
                "position-front",
                "theme-dark",
                "pagedim-black",
                "shadow-page",
                //"fx-panels-slide-100",
            ],
            "navbars": [
                {
                    "position": "top",
                    "content": [
                        "breadcrumbs",
                        //"next",
                        "close"
                    ]
                }
            ]
        })
    }
}
</script>
