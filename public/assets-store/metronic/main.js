"use strict";
function cropImage(inputDataURI, width) {
    return new Promise((resolve, reject) => {
        if (inputDataURI.slice(0, 10) !== "data:image") {
        reject(new Error("Not an image."));
        }
        const c = document.createElement("canvas");
        // c.width = 245;
        // c.height = 300;
        c.width = c.height = width || 100;
        const ctx = c.getContext("2d");
        const i = document.createElement("img");
        i.addEventListener("load", function () {
        ctx.drawImage(i, ...getWidthHeightImage(i, width));
        resolve(c.toDataURL("image/jpeg", 0.8));
        });
        i.src = inputDataURI;
    });
};    
function getWidthHeightImage(img, side) {
    const { width, height } = img;
    if (width === height) {
        return [0, 0, side, side];
    } else if (width < height) {
        const rat = height / width;
        const top = (side * rat - side) / 2;
        return [0, -1 * top, side, side * rat];
    } else {
        const rat = width / height;
        const left = (side * rat - side) / 2;
        return [-1 * left, 0, side * rat, side];
    }
};

function resizeBase64Img(base64,file) {
    var canvas = document.createElement("canvas");
    var ctx=canvas.getContext("2d");
    var cw=canvas.width;
    var ch=canvas.height;

    var maxW=300;
    var maxH=300 ;
    let img = document.createElement("img");
    img.src = base64;
    img.onload = function () {
       var iw=img.width;
       var ih=img.height;
       var scale=Math.min((maxW/iw),(maxH/ih));
       var iwScaled=iw*scale;
       var ihScaled=ih*scale;
       canvas.width=iwScaled;
       canvas.height=ihScaled;
       ctx.drawImage(img,0,0,iwScaled,ihScaled);
       $('.dzinput').append(`
       <input value="${canvas.toDataURL()}" hidden required="required" name="dz_file[]" />
       `);
       file.previewElement.classList.add("dz-success");
    }
    return; 
 }
 function imageFileDrop(id,name,max){
    Dropzone.autoDiscover = false;
    $('#'+id).dropzone({
          url: "/ajax_file_upload_handler/",
          addRemoveLinks: true,
          maxFiles: max, 
          acceptedFiles: 'image/*',
          accept: function(file) {
             let fileReader = new FileReader();
             fileReader.readAsDataURL(file);
             const addd = this.files;
             fileReader.onloadend = async function(i, event) {
                   let content = fileReader.result;
                   const cropImageProccess = await cropImage(content, 300).then((img) => {
                        return img;
                   });
                   await resizeBase64Img(cropImageProccess,file);
                   $('#'+id).find('.dz-remove').html('Remove or Change '+ name);
             }
             file.previewElement.classList.add("dz-complete");
             $('#'+id).css("background-color", "#ffffff");
          },
          init: function(){
            this.on("error", function(file){$('#'+id).css("background-color", "#ffaeae");});
            this.on("addedfile", function(file) {
                var fild = this.files[0];
                if (this.files[5]!=null){
                    this.removeFile(fild);
                }
            });
        }
      });
 }
$(document).ready(function() {
});
