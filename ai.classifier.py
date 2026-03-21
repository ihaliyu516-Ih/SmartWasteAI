import sys
import random

def classify_waste(image_path):
    # This simulates our AI analysis
    categories = ["Plastic", "Organic", "Recyclable", "General Waste"]
    return random.choice(categories)

# CRITICAL FIX: Use TWO underscores __ on both sides
if _name_ == "_main_":
    if len(sys.argv) > 1:
        # sys.argv[1] is the image path sent by PHP
        result = classify_waste(sys.argv[1])
        print(result)