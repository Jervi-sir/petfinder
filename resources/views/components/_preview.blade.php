<div class="preview-container">
    <div class="pet-container" >
        <div class="image">
            <div class="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item">
                        <template x-for="(image, index) in images">
                            <input class="carousel-open" type="radio" :id="$id('carousel-')" name="carousel" aria-hidden="true" hidden="" checked="checked">

                            <img :src='image' alt="">
                        </template>
                    </div>
                    
    
                    <label for="carousel-4" class=" prev control-1"></label>
                    <label for="carousel-3" class=" prev control-4"></label>
                    <label for="carousel-2" class=" next control-1"></label>
                    <label for="carousel-1" class=" prev control-2"></label>
    
                    <label for="carousel-4" class=" prev control-1"></label>
                    <label for="carousel-3" class=" next control-2"></label>
                    <label for="carousel-2" class=" prev control-3"></label>
                    <label for="carousel-1" class=" next control-3"></label>
    
                    <ol class="carousel-indicators">
                        <template x-for="image in images">
                            <li>
                                <label :for="$id('carousel-')" class="carousel-bullet"></label>
                            </li>
                        </template>
                    </ol>
    
                </div>
            </div>
        </div>
        <div class="details">
            <h2 x-text="pet.name"></h2>
            <h3 x-text="selectedRace"></h3>
            <h4><img src="../images/location_empty.svg" alt=""> <span  x-text="pet.wilaya"></span></h4>
            <div class="bubbles">
                <span class="age" x-text="birthdate"></span>
                <span class="gender" x-text="pet.gender"></span>
                <span class="weight" x-text="pet.weight"></span>
                <span class="color" x-text="pet.color"></span>
            </div>
            <div class="bio" x-text="description"></div>
            <div class="actions">
                <div class="contact">
                    <img src="../images/phone.svg" alt="">
                    <span x-text="phone_number"></span>
                </div>
                <div class="message" >
                    <a href="tel:"><img src="../images/phone.svg" alt=""></a>
                    <a @click="openModal">Send message</a>
                </div>
            </div>
        </div>
    </div>
</div>