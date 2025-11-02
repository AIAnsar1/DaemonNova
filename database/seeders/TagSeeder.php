<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $tags = [
            'HTML', 'CSS', 'JavaScript', 'TypeScript', 'React', 'Next.js', 'Vue.js', 'Nuxt.js', 'Svelte', 'Solid.js',
            'TailwindCSS', 'Bootstrap', 'Material UI', 'Sass', 'Less', 'Vite', 'Webpack', 'Babel',

            'PHP', 'Laravel', 'Symfony', 'CodeIgniter', 'Yii', 'Slim', 'Lumen',
            'Python', 'Django', 'Flask', 'FastAPI', 'Tornado',
            'Node.js', 'Express', 'NestJS', 'AdonisJS',
            'Ruby', 'Rails',
            'Go', 'Fiber', 'Echo', 'Gin',
            'Java', 'Spring', 'Micronaut', 'Quarkus',
            'C#', '.NET', 'ASP.NET Core',

            'MySQL', 'PostgreSQL', 'SQLite', 'MongoDB', 'Redis', 'Elasticsearch', 'MariaDB', 'Cassandra', 'ClickHouse',
            'Prisma', 'Eloquent ORM', 'SQLAlchemy', 'Doctrine',

            'Flutter', 'React Native', 'Ionic', 'Swift', 'Kotlin', 'Jetpack Compose',

            'Docker', 'Kubernetes', 'Nginx', 'Apache', 'CI/CD', 'GitHub Actions', 'GitLab CI', 'Ansible', 'Terraform',
            'AWS', 'Azure', 'Google Cloud', 'DigitalOcean', 'Linux', 'Ubuntu', 'CentOS',

            'Machine Learning', 'Deep Learning', 'AI', 'TensorFlow', 'PyTorch', 'OpenAI', 'LangChain', 'Transformers',
            'Data Science', 'Pandas', 'NumPy', 'Matplotlib', 'Scikit-learn', 'NLP', 'Computer Vision',

            'Cybersecurity', 'Ethical Hacking', 'Pentesting', 'Kali Linux', 'Metasploit', 'Burp Suite', 'Nmap', 'Wireshark',
            'OSINT', 'CTF', 'Malware Analysis', 'Reverse Engineering', 'Cryptography',

            'UI Design', 'UX Design', 'Figma', 'Adobe XD', 'Photoshop', 'Illustrator', 'Blender', 'Three.js', 'Animation',

            'MVC', 'MVVM', 'Observer', 'Singleton', 'Factory', 'Strategy', 'Repository', 'Adapter', 'Decorator', 'Command',
            'CQRS', 'Event Sourcing', 'Dependency Injection',

            'Microservices', 'Monolith', 'Clean Architecture', 'Hexagonal Architecture', 'DDD', 'REST API', 'GraphQL',
            'gRPC', 'WebSockets', 'Serverless',

            'Testing', 'Unit Testing', 'TDD', 'BDD', 'Jest', 'Pest', 'PHPUnit', 'Pytest', 'Cypress',
            'Git', 'GitHub', 'GitLab', 'Bitbucket',
            'Agile', 'Scrum', 'Kanban',
            'DevRel', 'Documentation', 'Open Source', 'CLI Tools',
        ];

        foreach ($tags as $tag)
        {
            Tag::firstOrCreate(['title' => $tag]);
        }
    }
}
