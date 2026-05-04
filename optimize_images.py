#!/usr/bin/env python3
"""
Image Optimization Script - Compress and resize product images for faster loading
- Reduces file size by 60-80%
- Optimizes for web (max 800px width)
- Maintains quality while improving performance
"""
import os
import sys
from PIL import Image

def optimize_image(input_path, output_path=None, max_size=(800, 800), quality=75):
    """Optimize a single image for web use"""
    try:
        img = Image.open(input_path)

        # Convert to RGB if necessary (remove alpha channel for JPEG)
        if img.mode in ('RGBA', 'P', 'LA'):
            img = img.convert('RGB')

        # Get original size
        original_size = os.path.getsize(input_path)

        # Resize if larger than max_size
        if img.size[0] > max_size[0] or img.size[1] > max_size[1]:
            img.thumbnail(max_size, Image.Resampling.LANCZOS)

        # Determine output path
        if not output_path:
            base, ext = os.path.splitext(input_path)
            output_path = f"{base}_optimized{ext}"

        # Save optimized image
        img.save(output_path, 'JPEG', quality=quality, optimize=True, progressive=True)

        # Get new size
        new_size = os.path.getsize(output_path)
        reduction = ((original_size - new_size) / original_size) * 100

        print(f"✅ {os.path.basename(input_path)}")
        print(f"   Before: {original_size/1024:.1f}KB → After: {new_size/1024:.1f}KB (-{reduction:.1f}%)")

        return True, new_size

    except Exception as e:
        print(f"❌ Error processing {input_path}: {e}")
        return False, 0

def batch_optimize(directory):
    """Optimize all images in directory recursively"""
    supported_formats = ('.jpg', '.jpeg', '.JPG', '.JPEG', '.png', '.PNG')
    total_original = 0
    total_optimized = 0
    processed = 0
    failed = 0

    print("=" * 70)
    print("🖼️  IMAGE OPTIMIZATION STARTED")
    print("=" * 70)
    print(f"📁 Directory: {directory}")
    target = f"Max 800x800px, Quality: 75%"
    print(f"🎯 Target: {target}")
    print("-" * 70)

    for root, dirs, files in os.walk(directory):
        for file in files:
            if file.lower().endswith(supported_formats):
                input_path = os.path.join(root, file)

                # Skip already optimized files
                if '_optimized' in file:
                    continue

                original_size = os.path.getsize(input_path)
                total_original += original_size

                success, new_size = optimize_image(input_path)
                
                if success:
                    total_optimized += new_size
                    processed += 1
                else:
                    failed += 1

    print("-" * 70)
    print("\n📊 OPTIMIZATION SUMMARY:")
    print(f"   ✅ Processed: {processed} images")
    print(f"   ❌ Failed: {failed} images")
    print(f"   📦 Total Size: {total_original/1024/1024:.2f}MB → {total_optimized/1024/1024:.2f}MB")
    
    if total_original > 0:
        reduction = ((total_original - total_optimized) / total_original) * 100
        print(f"   🚀 Reduction: {reduction:.1f}% smaller!")
    
    print("=" * 70)
    return processed, failed

def create_thumbnails(directory, thumb_dir='assets/images/thumbs'):
    """Create small thumbnails for quick preview"""
    import shutil
    
    os.makedirs(thumb_dir, exist_ok=True)
    
    supported_formats = ('.jpg', '.jpeg', '.JPG', '.JPEG', '.png', '.PNG')
    
    print("\n📸 Creating thumbnails...")
    
    for root, dirs, files in os.walk(directory):
        for file in files:
            if file.lower().endswith(supported_formats) and '_optimized' in file:
                input_path = os.path.join(root, file)
                
                try:
                    img = Image.open(input_path)
                    img.thumbnail((200, 200), Image.Resampling.LANCZOS)
                    
                    thumb_name = f"thumb_{file.replace('_optimized', '')}"
                    thumb_path = os.path.join(thumb_dir, thumb_name)
                    
                    img.save(thumb_path, 'JPEG', quality=60, optimize=True)
                    print(f"   ✅ Created: {thumb_name}")
                    
                except Exception as e:
                    print(f"   ❌ Error: {e}")

if __name__ == "__main__":
    base_dir = os.path.dirname(os.path.abspath(__file__))
    reference_dir = os.path.join(base_dir, 'reference')

    if not os.path.exists(reference_dir):
        print(f"❌ Directory not found: {reference_dir}")
        sys.exit(1)

    # Run optimization
    processed, failed = batch_optimize(reference_dir)

    # Create thumbnails
    create_thumbnails(reference_dir)

    print("\n🎉 OPTIMIZATION COMPLETE!")
    print(f"\n💡 Next steps:")
    print(f"   1. Test the website with optimized images")
    print(f"   2. If images look good, replace originals with optimized versions")
    print(f"   3. For even faster loading, consider using WebP format")
