const image_input = document.querySelector("#image_input");
var uploaded_image;

image_input.addEventListener('change', function() {
  const reader = new FileReader();
  console.log(reader);
  reader.addEventListener('load', () => {
    uploaded_image = reader.result;
    document.querySelector("#display_images").style.backgroundImage = `url(${uploaded_image})`;
  });
  reader.readAsDataURL(this.files[0]);
});