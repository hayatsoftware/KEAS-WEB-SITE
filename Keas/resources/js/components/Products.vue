<template>
    <div class="row">
        <div class="col-6 col-lg-3">
            <strong class="filtre_head">{{trans.filter}}</strong>
            <div class="filtre">
                <div class="close"></div>
                <div class="form-group">
                    <input type="text" v-on:keyup.enter="filterProducts" :placeholder="trans.search_product" v-model="product_data.query">
                    <button @click="filterProducts"></button>
                </div>
                <div class="group country_products">
                    {{trans.country}} : {{trans.country_text}} - <a href="javascript:void(0)" @click="changeCountry()">{{trans.change}}</a>
                </div>
                <div class="filtre_scroll">
                    <div class="group open" v-if="categories.length">
                        <h2 class="head" v-if="parent_category_id != 15">{{trans.categories}}</h2>
                        <h2 class="head" v-else>{{trans.series}}</h2>
                        <ul style="display: block;" v-if="categories.length">
                            <li v-for="category in categories" :class="{'active':category.active}">
                                <a :href="category.url"><h3>{{category.name}} <i v-if="category.is_new">{{trans.new}}</i></h3></a>
                            </li>
                        </ul>
                    </div>
                    <div class="group" v-if="brands.length">
                        <h2 class="head">{{ trans.brands }}</h2>
                        <div class="checkbox_sub">
                            <div class="custom-control custom-checkbox" v-for="brand in brands">
                                <input type="checkbox" class="custom-control-input" :value="brand.id" :id="brand.slug" v-model="product_data.brand">
                                <label class="custom-control-label" :for="brand.slug">
                                    <h3>{{brand.name}}</h3>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="group" v-if="waters.length">
                        <h2 class="head">{{trans.water_resistance}}</h2>
                        <div class="checkbox_sub">
                            <div class="custom-control custom-checkbox" v-for="water in waters">
                                <input type="checkbox" class="custom-control-input" :value="water.id" :id="'decor_'+water.slug" v-model="product_data.water">
                                <label class="custom-control-label" :for="'decor_'+water.slug">
                                    <h3>{{water.name}}</h3>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="group" v-if="decors.length">
                        <h2 class="head">{{trans.decors}}</h2>
                        <div class="checkbox_sub">
                            <div class="custom-control custom-checkbox" v-for="decor in decors">
                                <input type="checkbox" class="custom-control-input" :value="decor.id" :id="'decor_'+decor.slug" v-model="product_data.decor">
                                <label class="custom-control-label" :for="'decor_'+decor.slug">
                                    <h3>{{decor.name}}</h3>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="group" v-if="surfaces.length">
                        <h2 class="head">{{trans.surface}}</h2>
                        <div class="checkbox_sub">
                            <div class="custom-control custom-checkbox" v-for="surface in surfaces">
                                <input type="checkbox" class="custom-control-input" :value="surface.id" :id="'surface_'+surface.slug" v-model="product_data.surface">
                                <label class="custom-control-label" :for="'surface_'+surface.slug">
                                    <h3>{{surface.name}}</h3>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="group" v-if="textures.length">
                        <h2 class="head">{{trans.texture}}</h2>
                        <div class="checkbox_sub">
                            <div class="custom-control custom-checkbox" v-for="texture in textures">
                                <input type="checkbox" class="custom-control-input" :value="texture.id" :id="'texture_'+texture.slug" v-model="product_data.texture">
                                <label class="custom-control-label" :for="'texture_'+texture.slug">
                                    <h3>{{texture.name}}</h3>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="group" v-if="extra_features.length">
                        <h2 class="head">{{trans.extra_features}}</h2>
                        <div class="checkbox_sub">
                            <div class="custom-control custom-checkbox" v-for="feature in extra_features">
                                <input type="checkbox" class="custom-control-input" :value="feature.id" :id="'extra_feature_'+feature.slug" v-model="product_data.extra_feature">
                                <label class="custom-control-label" :for="'extra_feature_'+feature.slug">
                                    <h3>{{feature.name}}</h3>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="group" v-if="dimensions.length">
                        <h2 class="head">{{trans.dimensions}}</h2>
                        <div class="checkbox_sub">
                            <div class="custom-control custom-checkbox" v-for="dimension in dimensions">
                                <input type="checkbox" class="custom-control-input" :value="dimension.id" :id="'extra_feature_'+dimension.slug" v-model="product_data.dimension">
                                <label class="custom-control-label" :for="'extra_feature_'+dimension.slug">
                                    <h3>{{dimension.name}}</h3>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="group" v-if="thicknesses.length">
                        <h2 class="head">{{trans.thicknesses}}</h2>
                        <div class="checkbox_sub">
                            <div class="custom-control custom-checkbox" v-for="thickness in thicknesses">
                                <input type="checkbox" class="custom-control-input" :value="thickness.id" :id="'extra_feature_'+thickness.slug" v-model="product_data.thickness">
                                <label class="custom-control-label" :for="'extra_feature_'+thickness.slug">
                                    <h3>{{thickness.name}}</h3>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="group" v-if="locks.length">
                        <h2 class="head">{{trans.locks}}</h2>
                        <div class="checkbox_sub">
                            <div class="custom-control custom-checkbox" v-for="lock in locks">
                                <input type="checkbox" class="custom-control-input" :value="lock.id" :id="'extra_feature_'+lock.slug" v-model="product_data.lock">
                                <label class="custom-control-label" :for="'extra_feature_'+lock.slug">
                                    <h3>{{lock.name}}</h3>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="group" v-if="bevels.length">
                        <h2 class="head">{{trans.bevels}}</h2>
                        <div class="checkbox_sub">
                            <div class="custom-control custom-checkbox" v-for="bevel in bevels">
                                <input type="checkbox" class="custom-control-input" :value="bevel.id" :id="'extra_feature_'+bevel.slug" v-model="product_data.bevel">
                                <label class="custom-control-label" :for="'extra_feature_'+bevel.slug">
                                    <h3>{{bevel.name}}</h3>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="group" v-if="classes.length">
                        <h2 class="head">{{trans.classes}}</h2>
                        <div class="checkbox_sub">
                            <div class="custom-control custom-checkbox" v-for="class_string in classes">
                                <input type="checkbox" class="custom-control-input" :value="class_string.id" :id="'extra_feature_'+class_string.slug" v-model="product_data.class">
                                <label class="custom-control-label" :for="'extra_feature_'+class_string.slug">
                                    <h3>{{class_string.name}}</h3>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="group" v-if="heights.length">
                        <h2 class="head">{{trans.height}}</h2>
                        <div class="checkbox_sub">
                            <div class="custom-control custom-checkbox" v-for="height in heights">
                                <input type="checkbox" class="custom-control-input" :value="height.id" :id="'extra_feature_'+height.slug" v-model="product_data.height">
                                <label class="custom-control-label" :for="'extra_feature_'+height.slug">
                                    <h3>{{height.name}}</h3>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <a :href="category_url" v-show="product_data.bevel.length || product_data.lock.length || product_data.surface.length || product_data.brand.length || product_data.decor.length || product_data.dimension.length || product_data.thickness.length || product_data.class.length || product_data.extra_feature.length || product_data.height.length" class="reset" style="display: none">{{trans.clear_filter}}</a>
            </div>
        </div>
        <div class="col-lg-9 pl-xl-5">
            <div class="load" style="position: absolute;top:100px;left:50px;" v-show="loading">
                <svg class="spinner" width="65px" height="65px" viewBox="0 0 66 66" xmlns="http://www.w3.org/2000/svg">
                    <circle class="path" fill="none" stroke-width="6" stroke-linecap="round" cx="33" cy="33" r="30"></circle>
                </svg>
                {{trans.products_loading}}
            </div>
            <div class="giz">
                <div class="row">
                    <div class="col-5 col-lg-12">
                        <div class="filtre_title">{{trans.filter}}</div>
                    </div>
                    <div class="col-7 col-lg-9 order-lg-1">
                        <div class="apperarance">
                            <div class="custom-control custom-checkbox" v-if="is_new > 0">
                                <input type="checkbox" class="custom-control-input" id="only_news" value="1" v-model="product_data.is_new">
                                <label class="custom-control-label" for="only_news">
                                    {{trans.only_news}}
                                </label>
                            </div>
                            <nav  v-if="view_data.decor_view_button">
                                <a @click="changeView(1)" :class="{'active': decor_view === 1}">{{trans.decor_view}}</a>
                                <a @click="changeView(0)" :class="{'active': decor_view === 0}">{{trans.interior_view}}</a>
                            </nav>
                        </div>
                    </div>
                    <div class="col-12 apperarance mob_list" v-if="view_data.decor_view_button">
                        <nav>
                            <a @click="changeView(1)" :class="{'active': decor_view === 1}">{{trans.decor_view}}</a>
                            <a @click="changeView(0)" :class="{'active': decor_view === 0}">{{trans.interior_view}}</a>
                        </nav>
                    </div>
                    <div class="col-lg-3 text-lg-left text-right">
                        <div class="loading">{{product_count !== false ? product_count:products.length}} {{trans.listed_product}}</div>
                    </div>
                </div>
                <div class="product_list" :class="(decor_view === 1 ? view_data.product_list : 'nenue_view')" v-show="!loading" v-if="products.length">
                    <div class="row">
                        <div :class="(decor_view === 1 ? view_data.col_list : 'col-xl-4 col-lg-6 col-sm-6')" v-for="product in products" v-if="decor_view === 1 || (decor_view === 0 && product.image_interior_exists) ">
                            <div class="list">
                                <a :href="product.url">
                                    <picture v-if="decor_view === 0">
                                        <a :href="product.url">
                                            <img :src="product.image_interior" :alt="product.name" style="">
                                        </a>
                                        <span><a :href="product.image_interior" data-fancybox="" class="pop"></a></span>
                                    </picture>
                                    <picture v-if="decor_view === 1">
                                        <i v-if="product.is_new">{{trans.new}}</i>
                                        <i v-if="product.is_coming_soon">{{trans.coming_soon}}</i>
                                        <img :src="product.image" :alt="product.name" >

                                    </picture>
                                    <div class="name">
                                        <b>{{product.name}}</b>
                                        <small>{{product.decor_code}} <em class="sm" v-if="product.brand">{{product.brand}}</em></small>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>


    export default {
        watch:{
            'product_data.brand':{
                handler(){
                    if(this.firstLoad){
                        this.filterProducts();
                    }
                }
            },
            'product_data.water':{
                handler(){
                    if(this.firstLoad){
                        this.filterProducts();
                    }
                }
            },
            'product_data.decor':{
                handler(){
                    if(this.firstLoad){
                        this.filterProducts();
                    }
                }
            },
            'product_data.surface':{
                handler(){
                    if(this.firstLoad){
                        this.filterProducts();
                    }
                }
            },
            'product_data.texture':{
                handler(){
                    if(this.firstLoad){
                        this.filterProducts();
                    }
                }
            },
            'product_data.extra_feature':{
                handler(){
                    if(this.firstLoad){
                        this.filterProducts();
                    }
                }
            },
            'product_data.dimension':{
                handler(){
                    if(this.firstLoad){
                        this.filterProducts();
                    }
                }
            },
            'product_data.thickness':{
                handler(){
                    if(this.firstLoad){
                        this.filterProducts();
                    }
                }
            },
            'product_data.lock':{
                handler(){
                    if(this.firstLoad){
                        this.filterProducts();
                    }
                }
            },
            'product_data.bevel':{
                handler(){
                    if(this.firstLoad){
                        this.filterProducts();
                    }
                }
            },
            'product_data.class':{
                handler(){
                    if(this.firstLoad){
                        this.filterProducts();
                    }
                }
            },
            'product_data.height':{
                handler(){
                    if(this.firstLoad){
                        this.filterProducts();
                    }
                }
            },
            'product_data.is_new':{
                handler(){
                    if(this.firstLoad){
                        this.filterProducts();
                    }
                }
            },
            'decor_view':{
                handler(val){
                    if(val === 0){
                        this.product_count = this.products.filter((product) => {
                            return product.image_interior_exists;
                        }).length;
                    }else{
                        this.product_count = false;
                    }
                }
            }
        },
        data(){
            return{
                trans:window.trans,
                categories:[],
                current_category:window.category_id,
                parent_category_id:window.category_parent_id,
                category_url:window.category_url,
                loading:false,
                brands:[],
                waters:[],
                decors:[],
                textures:[],
                surfaces:[],
                dimensions:[],
                thicknesses:[],
                extra_features:[],
                locks:[],
                bevels:[],
                classes:[],
                heights:[],
                csrf:window._token,
                lg:window.activeLanguageId,
                cg:window.activeCountryId,
                product_data:{
                    brand:[],
                    decor:[],
                    water:[],
                    texture:[],
                    surface:[],
                    extra_feature:[],
                    dimension:[],
                    thickness:[],
                    lock:[],
                    bevel:[],
                    class:[],
                    height:[],
                    is_new:false,
                    query:""
                },
                products:[],
                is_new : 0,
                decor_view:1,
                view_data:window.view_data,
                product_count:false,
                hash:"",
                searchParams:window.searchData,
                firstLoad:false
            }
        },
        created() {
            if(this.parent_category_id != 15 && this.parent_category_id != 16 && (this.parent_category_id != 2 && this.current_category != 2)){
                this.getCategories();
                this.getBrands();
                this.getExtraFeatures();
                this.getDimensions();
                this.getDecors();
                this.getSurfaces();
                this.getTextures();
            }else if(this.parent_category_id == 2 || this.current_category == 2){
                this.getCategories();
                this.getExtraFeatures();
            }else{
                this.getCategories();
                this.getThicknesses();
                this.getLocks();
                this.getBevels();
                this.getClasses();
                this.getWaters();
                if(this.current_category == 72){
                    this.getHeights();
                }
                this.getDecors();
                this.getSurfaces();
            }

        },
        mounted() {
            let params = this.searchParams;
            for( let i in this.product_data ){
                if( i != 'is_new' && i != 'query' ){
                    this.product_data[i] = params[i] ?? [];
                }else if( i == 'is_new' ){
                    this.product_data[i] = params[i] ?? false;
                }else{
                    this.product_data[i] = params[i] ?? "";
                }

            }
            this.filterProducts();
        },
        methods:{
            async getCategories(){
                let _self = this;
                axios.post('/getCategories', {
                    category_id:_self.current_category,
                    parent_category_id:_self.parent_category_id,
                    lg:_self.lg,
                    cg:_self.cg
                },{
                    headers:{
                        'X-CSRF-TOKEN': _self.csrf
                    }
                }).then((res) => {
                    if(res.data.length){
                        _self.categories = res.data;
                    }
                })
            },
            async getBrands(){
                let _self = this;
                axios.post('/getBrands', {
                    category_id:_self.current_category,
                    lg:_self.lg,
                    cg:_self.cg
                },{
                    headers:{
                        'X-CSRF-TOKEN': _self.csrf
                    }
                }).then((res) => {
                    if(res.data.length){
                        _self.brands = res.data;
                    }
                });
            },
            async getDecors(){
                let _self = this;
                axios.post('/getDecors', {
                    category_id:_self.current_category,
                    lg:_self.lg,
                    cg:_self.cg
                },{
                    headers:{
                        'X-CSRF-TOKEN': _self.csrf
                    }
                }).then((res) => {
                    if(res.data.length){
                        _self.decors = res.data;
                    }
                });
            },
            async getWaters(){
                let _self = this;
                axios.post('/getWaters', {
                    category_id:_self.current_category,
                    lg:_self.lg,
                    cg:_self.cg
                },{
                    headers:{
                        'X-CSRF-TOKEN': _self.csrf
                    }
                }).then((res) => {
                    if(res.data.length){
                        _self.waters = res.data;
                    }
                });
            },
            async getTextures(){
                let _self = this;
                axios.post('/getTextures', {
                    category_id:_self.current_category,
                    lg:_self.lg,
                    cg:_self.cg
                },{
                    headers:{
                        'X-CSRF-TOKEN': _self.csrf
                    }
                }).then((res) => {
                    if(res.data.length){
                        _self.textures = res.data;
                    }
                });
            },
            async getSurfaces(){
                let _self = this;
                axios.post('/getSurfaces', {
                    category_id:_self.current_category,
                    lg:_self.lg,
                    cg:_self.cg
                },{
                    headers:{
                        'X-CSRF-TOKEN': _self.csrf
                    }
                }).then((res) => {
                    if(res.data.length){
                        _self.surfaces = res.data;
                    }
                });
            },
            async getExtraFeatures(){
                let _self = this;
                axios.post('/getExtraFeatures', {
                    category_id:_self.current_category,
                    lg:_self.lg,
                    cg:_self.cg
                },{
                    headers:{
                        'X-CSRF-TOKEN': _self.csrf
                    }
                }).then((res) => {
                    if(res.data.length){
                        _self.extra_features = res.data;
                    }
                });
            },
            async getDimensions(){
                let _self = this;
                axios.post('/getDimensions', {
                    category_id:_self.current_category,
                    lg:_self.lg,
                    cg:_self.cg
                },{
                    headers:{
                        'X-CSRF-TOKEN': _self.csrf
                    }
                }).then((res) => {
                    if(res.data.length){
                        _self.dimensions = res.data;
                    }
                });
            },
            async getThicknesses(){
                let _self = this;
                axios.post('/getThickness', {
                    category_id:_self.current_category,
                    lg:_self.lg,
                    cg:_self.cg
                },{
                    headers:{
                        'X-CSRF-TOKEN': _self.csrf
                    }
                }).then((res) => {
                    if(res.data.length){
                        _self.thicknesses = res.data;
                    }
                });
            },
            async getLocks(){
                let _self = this;
                axios.post('/getLocks', {
                    category_id:_self.current_category,
                    lg:_self.lg,
                    cg:_self.cg
                },{
                    headers:{
                        'X-CSRF-TOKEN': _self.csrf
                    }
                }).then((res) => {
                    if(res.data.length){
                        _self.locks = res.data;
                    }
                });
            },
            async getBevels(){
                let _self = this;
                axios.post('/getBevels', {
                    category_id:_self.current_category,
                    lg:_self.lg,
                    cg:_self.cg
                },{
                    headers:{
                        'X-CSRF-TOKEN': _self.csrf
                    }
                }).then((res) => {
                    if(res.data.length){
                        _self.bevels = res.data;
                    }
                });
            },
            async getClasses(){
                let _self = this;
                axios.post('/getClass', {
                    category_id:_self.current_category,
                    lg:_self.lg,
                    cg:_self.cg
                },{
                    headers:{
                        'X-CSRF-TOKEN': _self.csrf
                    }
                }).then((res) => {
                    if(res.data.length){
                        _self.classes = res.data;
                    }
                });
            },
            async getHeights(){
                let _self = this;
                axios.post('/getHeights', {
                    category_id:_self.current_category,
                    lg:_self.lg,
                    cg:_self.cg
                },{
                    headers:{
                        'X-CSRF-TOKEN': _self.csrf
                    }
                }).then((res) => {
                    if(res.data.length){
                        _self.heights = res.data;
                    }
                });
            },
            filterProducts(){
                let _self = this;
                _self.loading = true;
                this.setUrlParams(this.product_data);
                $("html, body").animate({ scrollTop: 0 }, "slow");
                axios.post('/filterProducts', {
                    category_id:_self.current_category,
                    parent_category_id:_self.parent_category_id,
                    lg:_self.lg,
                    cg:_self.cg,
                    product_data:_self.product_data
                },{
                    headers:{
                        'X-CSRF-TOKEN': _self.csrf
                    }
                }).then((res) => {
                    _self.firstLoad = true;
                    if(res.data.status == 1){
                        _self.products = res.data.data;
                        _self.is_new = res.data.is_new;
                        if( _self.decor_view === 0 ){
                            _self.product_count = _self.products.filter((product) => {
                                return product.image_interior_exists;
                            }).length;
                        }else{
                            _self.product_count = false;
                        }
                    }

                    _self.loading = false;
                });
            },
            changeView(val){
                this.decor_view = val;
            },
            changeCountry(){
                $('.language-wrap').show();
            },
            setUrlParams(params){
                this.hash = '';
                if (Object.keys(params).length){
                    let parts = [];
                    for (let i in params) {
                        if (params.hasOwnProperty(i) && params[i] != '') {
                            if( i != 'is_new' && i != 'query' ){
                                for( let e = 0; e < params[i].length; e++){
                                    parts.push(encodeURIComponent(i) + "[]=" + encodeURIComponent(params[i][e]));
                                }
                            }else{
                                parts.push(encodeURIComponent(i) + "=" + encodeURIComponent(params[i]));
                            }
                        }
                    }
                    this.hash = parts.join("&");
                }
                if( this.firstLoad ){
                    window.history.pushState(null, '', window.location.pathname+'?'+this.hash);
                }
            },

        }
    }
</script>
