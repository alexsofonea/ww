from flask import Flask, request, jsonify
import torch
from diffusers import FluxPipeline
from PIL import Image
import io
import base64
import os

# Initialize the model pipeline
pipe = FluxPipeline.from_pretrained("black-forest-labs/FLUX.1-dev", torch_dtype=torch.bfloat16)
pipe.load_lora_weights("Shakker-Labs/FLUX.1-dev-LoRA-Logo-Design", weight_name="FLUX-dev-lora-Logo-Design.safetensors")
pipe.fuse_lora(lora_scale=0.8)
pipe.to("cuda")

# Create a Flask app
app = Flask(__name__)

@app.route('/generate', methods=['POST'])
def generate_image():
    try:
        # Get the JSON data from the request
        data = request.json
        prompt = data.get("prompt")
        if not prompt:
            return jsonify({"error": "Prompt is required"}), 400

        # Generate the image
        image = pipe(prompt, num_inference_steps=24, guidance_scale=3.5).images[0]

        # Save the image to a BytesIO object
        img_bytes = io.BytesIO()
        image.save(img_bytes, format='PNG')
        img_bytes.seek(0)

        # Encode the image in base64
        img_base64 = base64.b64encode(img_bytes.read()).decode('utf-8')

        # Return the base64 image data in JSON
        return jsonify({"image_base64": img_base64})
    except Exception as e:
        return jsonify({"error": str(e)}), 500

# Run the app
if __name__ == "__main__":
    port = int(os.environ.get("PORT", 5000))
    app.run(host="0.0.0.0", port=port)